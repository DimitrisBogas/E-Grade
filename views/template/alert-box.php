<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27/12/2015
 * Time: 2:31 πμ
 */
if(isset($_SESSION['errors'])) {
    foreach($_SESSION['errors'] as $k => $v)
        echo("
                        <div class='alert-message error'>
                            <div class='box-icon'></div>
                            <p> ". $v . "<a href='' class='close'>&times;</a>
                        </div>"
        );
    unset($_SESSION['errors']);
}