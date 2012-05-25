<?php

/**
 * The Comment Model.
 *
 * Fields:
 *
 * CommentID : key
 * UserID : key
 * MonumentID : key
 * PlaceDate : date
 * Comment : text
 *
 */

/*
 * filter (e.g. removing trailing spaces, modifies data)
 * normalize (converting a phone number to a standard format)
 * validate (checking whether or not the data is valid)
 *
 * TODO:
 *
 * Create a test page to fill in a comment
 * Create javascript that submits the form data
 * Test if the ajax controller actually works
 * Test if i can create a comment
 * Test if the validation of a comment works
 * Test if the comment is inserted/updated in the database
 * Rewrite the code and start over
 *
 */

class Model_Comment extends Model_Database {

	private $_data;

	public function __construct($data = null) {

        parent::__construct();

        if(is_array($data)) {

            $this->set($data);

        }
        else {

            $this->set('CommentID', $data);

        }

	}

    public function load() {

        $id = $this->get('CommentID');

        $r = DB::select('*')->from('Comment')->where('CommentID', '=', $id)->execute($this->_db);

        set($r->as_array());

    }

    public function save() {

        $validator = $this->validator();

        if(!$validator->check()) {
            throw new Exception("Can't save Comment because it contains invalid data");
        }

        if(!$this->get('CommentID')) {

            $data = $this->_data;
            unset($data['CommentID']);

            // create a new comment
            $q = DB::insert('Comment')
                ->columns(array_keys($data))
                ->values(array_values($data));

            // returns insert id and num affected rows
            list($insert_id) = $q->execute($this->_db);

            $this->set('CommentID', $insert_id);
        }
        else {

            $data = $this->_data;
            unset($data['CommentID']);

            // update the comment
            $q = DB::update('Comment')
                ->set($data);

            $q->execute($this->_db);

            // hope on success
        }

    }

    public function validator() {

        $validator = Validation::factory($this->_data);

        $validator->rules('CommentID', array(
            array('numeric'),
        ));

        $validator->rules('MonumentID', array(
            array('not_empty'),
            array('numeric'),
        ));

        $validator->rules('UserID', array(
            array('not_empty'),
            array('numeric'),
        ));

        $validator->rules('Comment', array(
            array('min_length', array(':value', 3)),
            array('max_length', array(':value', 500)),
        ));

        $validator->rules('PlaceDate', array(
            array('not_empty'),
            array('date'),
        ));

        return $validator;

    }

    public function set($key, $value = null) {

        if(is_array($key)) {

            // $value is ignored

            foreach($key as $k => $v) {
                $this->_data[$k] = $v;
            }

        }
        else {

            $this->_data[$key] = $value;

        }

        return $this;

    }

    public function get($key = null) {

        if(!$key) {
            return $this->_data;
        }

        if(is_array($key)) {

            foreach($key as $k) {
                $result[$k] = $this->_data[$k];
            }

            return $result;

        }

        return $this->_data[$key];

    }
}

?>
