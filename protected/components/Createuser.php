<?php
class Createuser extends CWidget
{
    public $action, $password, $email, $username, $pagename;
    public function init()
    {
    }
    public function run()
    {
        echo "<h1>$this->pagename</h1>
                <form action='" . $this->action . "' method='post' id='sub-form'>
                    <p>Fields with <span style='color:red'>*</span> are required.</p>
                    <label for='username' style='font-weight:bold;'>Username<span style='color:red'>*</span></label>
                    <br>
                    <input type='text'  style='margin-top:4px;width:55%;margin-bottom:12px' name='username' value='" . $this->username . "' required>
                    <br>
                    <label for='password' style='font-weight:bold;'>password<span style='color:red'>*</span></label>
                    <br>
                    <input type='text'  style='margin-top:4px;width:55%;margin-bottom:12px' name='password' value='" . $this->password . "' required>
                    <br>
                    <label for='email' style='font-weight:bold;'>email<span style='color:red'>*</span></label>
                    <br>
                    <input type='text'  style='margin-top:4px;width:55%;margin-bottom:12px' name='email' value='" . $this->email . "' required>
                    <br>
                    <input type='submit' value='submit' name='submit'>
                </form>";
    }

    public function add($x,$y){
        return $x+$y;
    }
}
