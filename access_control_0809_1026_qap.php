<?php
// 代码生成时间: 2025-08-09 10:26:20
// access_control.php
// 此文件实现了基本的访问权限控制功能

class AccessControl {
    // 用户角色常量
    const GUEST = 'guest';
    const USER = 'user';
    const ADMIN = 'admin';

    // 用户角色权限映射
    private $rolePermissions = array(
        self::GUEST => array('view'),
        self::USER => array('view', 'edit'),
        self::ADMIN => array('view', 'edit', 'delete')
    );

    // 检查用户是否有权限执行指定操作
    public function checkPermission($role, $action) {
        // 错误处理：检查角色是否有效
        if (!array_key_exists($role, $this->rolePermissions)) {
            throw new Exception('Invalid role');
        }

        // 检查用户是否有执行指定操作的权限
        if (in_array($action, $this->rolePermissions[$role])) {
            return true;
        } else {
            return false;
        }
    }

    // 设置用户角色
    public function setRole($role) {
        // 错误处理：检查角色是否有效
        if (!array_key_exists($role, $this->rolePermissions)) {
            throw new Exception('Invalid role');
        }

        // 设置当前用户角色
        $this->role = $role;
    }

    // 获取当前用户角色
    public function getRole() {
        return $this->role;
    }
}

// 使用示例
try {
    $accessControl = new AccessControl();
    $accessControl->setRole(AccessControl::ADMIN);
    
    if ($accessControl->checkPermission(AccessControl::ADMIN, 'delete')) {
        echo 'Admin has delete permission.';
    } else {
        echo 'Admin does not have delete permission.';
    }
} catch (Exception $e) {
    // 错误处理
    echo 'Error: ' . $e->getMessage();
}
