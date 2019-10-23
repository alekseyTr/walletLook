<?php
namespace App\Controllers;

use App\Components\App;
use App\Models\Wallet;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Controller
{
    public $title;

    public $action;

    function redirect($url, $statusCode = 302)
    {
        $response = new RedirectResponse($url, $statusCode);
        $response->send();
    }

    public function render($viewName, array $params = [])
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
        $this->title = 'Список кошельков';
        $wallets = Wallet::getAll();
        return $this->render('index', compact('wallets'));
    }

    public function actionAddWallet()
    {
        if ($form = App::$request->request->get('Wallet')) {
            $wallet = new Wallet($form);
            $wallet->save();
        }
        $this->redirect('/');
    }

    public function actionRemoveWallet()
    {
        if ($walletId = App::$request->query->get('id'))
            Wallet::deleteByPk($walletId);
        $this->redirect('/');
    }

    public function actionAllTransactions()
    {
        $this->title = 'Список всех транзакций';
        return $this->render('transactions');
    }

    public function actionWalletTransactions()
    {
        if (!$walletId = App::$request->query->get('id'))
            $this->redirect('/');
        $wallet = Wallet::getByPk($walletId);
        $this->title = 'Список транзакций';
        return $this->render('transactions', compact('wallet'));
    }

}