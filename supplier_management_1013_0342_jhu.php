<?php
// 代码生成时间: 2025-10-13 03:42:28
// Yii框架供应商管理系统
// 文件：supplier_management.php

class SupplierManagement extends CComponent {

    private $_supplierData; // 供应商数据
    private $_connection; // 数据库连接

    public function __construct($connection) {
        // 构造函数，初始化数据库连接和供应商数据
        $this->_connection = $connection;
        $this->_supplierData = array();
    }

    // 获取供应商列表
    public function getSupplierList() {
        try {
            // 从数据库获取供应商数据
            $cmd = $this->_connection->createCommand('SELECT * FROM suppliers');
            $this->_supplierData = $cmd->queryAll();
            return $this->_supplierData;
        } catch (Exception $e) {
            // 错误处理
            Yii::log('Error fetching supplier list: ' . $e->getMessage(), 'error', 'application');
            throw new CHttpException(500, 'Failed to retrieve supplier list.');
        }
    }

    // 添加供应商
    public function addSupplier($name, $contact, $address) {
        try {
            // 向数据库添加供应商
            $cmd = $this->_connection->createCommand(
                'INSERT INTO suppliers (name, contact, address) VALUES (:name, :contact, :address)'
            );
            $cmd->bindValue(':name', $name);
            $cmd->bindValue(':contact', $contact);
            $cmd->bindValue(':address', $address);
            $cmd->execute();
            return true;
        } catch (Exception $e) {
            // 错误处理
            Yii::log('Error adding supplier: ' . $e->getMessage(), 'error', 'application');
            throw new CHttpException(500, 'Failed to add supplier.');
        }
    }

    // 更新供应商信息
    public function updateSupplier($id, $name, $contact, $address) {
        try {
            // 更新数据库中的供应商信息
            $cmd = $this->_connection->createCommand(
                'UPDATE suppliers SET name = :name, contact = :contact, address = :address WHERE id = :id'
            );
            $cmd->bindValue(':id', $id);
            $cmd->bindValue(':name', $name);
            $cmd->bindValue(':contact', $contact);
            $cmd->bindValue(':address', $address);
            $cmd->execute();
            return true;
        } catch (Exception $e) {
            // 错误处理
            Yii::log('Error updating supplier: ' . $e->getMessage(), 'error', 'application');
            throw new CHttpException(500, 'Failed to update supplier.');
        }
    }

    // 删除供应商
    public function deleteSupplier($id) {
        try {
            // 从数据库删除供应商
            $cmd = $this->_connection->createCommand(
                'DELETE FROM suppliers WHERE id = :id'
            );
            $cmd->bindValue(':id', $id);
            $cmd->execute();
            return true;
        } catch (Exception $e) {
            // 错误处理
            Yii::log('Error deleting supplier: ' . $e->getMessage(), 'error', 'application');
            throw new CHttpException(500, 'Failed to delete supplier.');
        }
    }

    // 获取单个供应商信息
    public function getSupplierById($id) {
        try {
            // 从数据库获取单个供应商信息
            $cmd = $this->_connection->createCommand(
                'SELECT * FROM suppliers WHERE id = :id'
            );
            $cmd->bindValue(':id', $id);
            $supplier = $cmd->queryRow();
            return $supplier;
        } catch (Exception $e) {
            // 错误处理
            Yii::log('Error fetching supplier by ID: ' . $e->getMessage(), 'error', 'application');
            throw new CHttpException(500, 'Failed to retrieve supplier.');
        }
    }
}
