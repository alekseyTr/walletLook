<?php
namespace App\Controllers;

use App\Components\App;
use App\Models\Wallet;

class Controller
{
    public $title;

    public function render ($viewName, array $params = [])
    {
        extract($params);
        ob_start();
        require ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'layout.php';
        require ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR."$viewName.php";
        return ob_get_clean();
    }

    public function getTitle()
    {
        return $this->title ? : 'Main Page';
    }

    /* Actions */

    public function actionIndex()
    {
        $this->title = 'ETH wallet tracking';
        return $this->render('index');
    }

    public function actionAddWallet()
    {
        if ($form = App::$request->query->get('Wallet')) {
            $wallet = new Wallet($form);
            $wallet->save();
        }
        return $this->render('index');
    }

}