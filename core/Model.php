<?php 

class Model
{
    protected $_db, $_table, $_modelName, $_columnNames = [];

    public function __construct($table)
    {
        $this->_db = DB::getInstance(HOST,DB_NAME,DB_USER,DB_PASSWORD);
        $this->_table = $table;
        $this->_setTableColumns();
        $this->_modelName = ucwords(rtrim($this->_table,'table'));
    }

    protected function _setTableColumns()
    {
        $columns = $this->get_columns();

        foreach ($columns as $column) {
            $columnName = $column->Field;
            $this->_columnNames[] = $column->Field;
            $this->{$columnName}  = null;
        }
    }

    public function get_columns()
    {
        return $this->_db->get_columns($this->_table);
    }

    public function find($params = [])
    {
        $results = [];
        $resultsQuery = $this->_db->find($this->_table, $params);
        if (!$resultsQuery) return $results;
        //dnd($resultsQuery);
        foreach ($resultsQuery as $result) {
            $obj = ($this->_modelName === 'Item')? new $this->_modelName(DummyItem::getInstance(-1)) :new $this->_modelName($this->_table);
            $obj->populateObjData($result);
            $results[] = $obj;
        }

        return $results;
    }

    public function findFirst($params = [])
    {
        $resultsQuery = $this->_db->findFirst($this->_table, $params);
        // $result = new $this->_modelName($this->_table);
        if ($resultsQuery) {
            $this->populateObjData($resultsQuery);
        }
        // return $this;
    }

    protected function populateObjData($results)
    {
        foreach ($results as $key => $value) {
            $this->$key = $value;
        }
    }

    public function findById($id)
    {
        $this->findFirst([
            'conditions' => ['id=?'],
            'bind' => [$id]
        ]);
    }

    public function save()
    {
        $fields = [];
        foreach ($this->_columnNames as $column) {
            $fields[$column] = $this->$column;
        }

        // determine whether to update or insert
        if (property_exists($this, 'id') && $this->id != '') {
            return $this->update($this->id, $fields);
        } else {
            return $this->insert($fields);
        }
    }

    public function insert($fields)
    {
        if (empty($fields)) {
            return false;
        } else {
            return $this->_db->insert($this->_table, $fields);
        }
    }

    public function update($id, $fields)
    {
        if (empty($fields) || $id == '') {
            return false;
        }
        return $this->_db->update($this->_table, $id, $fields);
    }

    public function delete($id)
    {
        if ($id == '' && $this->id == '') return false;
        $id = ($id == '') ? $this->id : $id;

        $this->update($id, ['deleted' => 1]);

        return $this->_db->delete($this->table, $id);
    }

    public function query($sql, $bind = [])
    {
        return $this->_db->query($sql, $bind);
    }

    public function data()
    {
        $data = new stdClass();
        foreach ($this->_columnNames as $column) {
            $data->{$column} = $this->{$column};
        }
        return $data;
    }



    public function assign($params)
    {
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (in_array($key, $this->_columnNames)) {
                    $this->$key = sanitize($val);
                }
            }
            return true;
        }
        return false;
    }
}
