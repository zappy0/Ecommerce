<?php
namespace UnitTest\Test ;
use PHPUnit\Framework\TestCase ;
require 'C:/xampp/htdocs/Ecommerce-website/components/user_model.php';
require 'C:/xampp/htdocs/Ecommerce-website/components/connect.php';


class testcases extends TestCase
{
    public function testUpdateOrderStatus()
    {
        // $admin_id=5;
        $admin_id=1;
        $this->assertSame(-1,getTotalPendings($admin_id));
    }

    public function testUpdateProfile()
    {
        // $admin_id=5;
        $admin_id=1;
        $this->assertSame(0,updateAdminProfile($admin_id));
    }

    public function testUpdateAddProducts()
    {
        // $admin_id=5;
        $admin_id=1;
        $this->assertSame(-1,getProductsAdded($admin_id));
    }

    public function testManageUsers()
    {
        // $admin_id=5;
        $admin_id=1;
        $this->assertSame(-1,getNumUsers($admin_id));
    }

    public function testManageAdmins()
    {
        // $admin_id=5;
        $admin_id=1;
        $this->assertSame(-1,getAdminUsers($admin_id));
    }



}

