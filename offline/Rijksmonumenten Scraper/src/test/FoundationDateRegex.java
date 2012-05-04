package test;

import java.util.regex.Pattern;
import java.util.regex.Matcher;

public class FoundationDateRegex {

	public static void main(String arguments[]) {
		test();
	}
	
    public static void test() {
        Object data[] = {
        		"1432", 1432,
        		"ca. 1400", 1400,
        		"1547-1563", 1563,
        		"1920-'30", 1930,
        		"14e eeuw", 1400,
        		"14e-15e eeuw", 1500,
        };
        
        for(int i = 0; i < data.length; i += 2) {
        	System.out.println("getYear(\"" + data[i] + "\") => " + getYear((String)data[i]) + ", expected " + (int)data[i + 1]);
        }
   
    }
    
    public static int getYear(String date) {
    	int year1 = 0;
    	int year2 = 0;
    	
    	Matcher year4m = Pattern.compile("\\d{4}").matcher(date);
    	Matcher year2m = Pattern.compile("'\\d{2}").matcher(date);
    	Matcher cent2m = Pattern.compile("\\d{2}e").matcher(date);
    	
    	if(year4m.find()) {
    		// 1234
    		year1 = Integer.parseInt(year4m.group());
    		
    		if(year4m.find()) {
    			// 1234 xxx 4312
    			year2 = Integer.parseInt(year4m.group());
    		}
    		else if(year2m.find()) {
    			// 1234-'54
    			int c = ((int)(year1/100))*100;
    			year2 = Integer.parseInt(year2m.group().substring(1, 3)) + c;
    		}
    	}
    	else if(cent2m.find()) {
    		// 14e 
    		year1 = Integer.parseInt(cent2m.group().substring(0, 2)) * 100;
    		
    		if(cent2m.find()) {
    			// 14e - 15e
    			year2 = Integer.parseInt(cent2m.group().substring(0, 2)) * 100;
    		}
    	}
    	
    	int year = (year2 != 0) ? year2 : year1;
    	
    	return year;
    }
}

