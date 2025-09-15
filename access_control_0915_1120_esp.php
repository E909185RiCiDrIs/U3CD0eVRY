<?php
// 代码生成时间: 2025-09-15 11:20:29
// AccessControl.php
// 这个文件提供了访问权限控制功能，确保不同用户根据其角色访问不同的资源。

class AccessControl extends CWebUser {
    // 定义用户角色常量
    const ROLE_GUEST = 0;
    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;

    // 检查用户是否有权限访问指定的资源
    public function checkAccess($role) {
        // 从用户会话中获取用户的角色
        $userRole = $this->getState('role');

        // 如果用户角色不匹配，则抛出异常
        if ($userRole < $role) {
            throw new CHttpException(403, 'You do not have permission to access this page.');
        }

        // 如果用户角色匹配，则允许访问
        return true;
    }

    // 设置用户角色
    public function setRole($role) {
        $this->setState('role', $role);
    }

    // 获取用户角色
    public function getRole() {
        return $this->getState('role');
    }

    // 检查用户是否为管理员
    public function isAdmin() {
        return $this->checkAccess(self::ROLE_ADMIN);
    }

    // 检查用户是否为普通用户
    public function isUser() {
        return $this->checkAccess(self::ROLE_USER);
    }

    // 检查用户是否为访客
    public function isGuest() {
        return $this->checkAccess(self::ROLE_GUEST);
    }
}

// 使用示例
try {
    $accessControl = new AccessControl();
    $accessControl->setRole(AccessControl::ROLE_USER);
    if ($accessControl->isAdmin()) {
        echo 'Access granted for admin.';
    } else {
        echo 'Access denied for admin.';
    }
} catch (CHttpException $e) {
    // 错误处理
    echo 'Error: ' . $e->getMessage();
}
