<?php
// 代码生成时间: 2025-09-07 04:36:50
 * It is designed to be easy to understand and maintain,
 * with proper error handling and documentation.
 */
class DataModel {

    /**
     * @var \Yii\db\ActiveRecord
     * The ActiveRecord instance for database operations.
     */
    private $ar;

    /**
     * DataModel constructor.
     * @param \Yii\db\ActiveRecord $ar The ActiveRecord instance to use.
     */
    public function __construct($ar) {
        $this->ar = $ar;
    }

    /**
     * Fetches all records from the associated table.
     * @return \Yii\db\ActiveRecord[]
     */
    public function findAll() {
        try {
            return $this->ar::find()->all();
        } catch (\Yii\db\Exception $e) {
            // Log error and rethrow exception
            \Yii::error($e->getMessage(), __METHOD__);
            throw $e;
        }
    }

    /**
     * Finds a single record by primary key.
     * @param mixed $id The primary key value.
     * @return \Yii\db\ActiveRecord|null
     */
    public function findById($id) {
        try {
            return $this->ar::findOne($id);
        } catch (\Yii\db\Exception $e) {
            // Log error and rethrow exception
            \Yii::error($e->getMessage(), __METHOD__);
            throw $e;
        }
    }

    /**
     * Creates a new record in the database.
     * @param array $data The data to insert.
     * @return bool Whether the creation was successful.
     */
    public function create($data) {
        try {
            $model = new $this->ar;
            $model->setAttributes($data, false);
            return $model->save();
        } catch (\Yii\db\Exception $e) {
            // Log error and rethrow exception
            \Yii::error($e->getMessage(), __METHOD__);
            throw $e;
        }
    }

    /**
     * Updates an existing record in the database.
     * @param mixed $id The primary key value.
     * @param array $data The data to update.
     * @return bool Whether the update was successful.
     */
    public function update($id, $data) {
        try {
            $model = $this->ar::findOne($id);
            if ($model) {
                $model->setAttributes($data, false);
                return $model->save();
            }
            return false;
        } catch (\Yii\db\Exception $e) {
            // Log error and rethrow exception
            \Yii::error($e->getMessage(), __METHOD__);
            throw $e;
        }
    }

    /**
     * Deletes a record from the database.
     * @param mixed $id The primary key value.
     * @return bool Whether the deletion was successful.
     */
    public function delete($id) {
        try {
            $model = $this->ar::findOne($id);
            if ($model) {
                return $model->delete();
            }
            return false;
        } catch (\Yii\db\Exception $e) {
            // Log error and rethrow exception
            \Yii::error($e->getMessage(), __METHOD__);
            throw $e;
        }
    }
}
