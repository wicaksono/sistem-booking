<?php
/**
 * Class MigrateController
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class MigrateController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl'
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'roles'   => [UserAccount::IT],
                'actions' => ['account']
            ),
            array(
                'deny',
                'users' => ['*']
            )
        );
    }

    public function actionAccount()
    {
        set_time_limit(0);

        $saccs = DataOutsideAccount::model()->findAll();
        $daccs = CHtml::listData(DataOutsideAccount::model()->findAll(), 'code', 'name');

        foreach($saccs as $a) {
            if(array_key_exists($a->KOD_AE, $daccs)) continue;
            preg_match('/[a-zA-Z]+/', $a->NAMA_AE, $username);
            $username = strtoupper(substr($username[0], 0, 2) . str_pad($a->KOD_AE, 4, '0', STR_PAD_LEFT));
            $user = new UserAccount('create');
            $user->username = $username;
            $user->password = sha1($username);
            $user->identity = '0000000000';
            $user->realname = strtoupper($a->NAMA_AE);
            $user->division = 2;
            $user->save(false);
            $sales = new CommMigrateAccount('create');
            $sales->user_id = $user->id;
            $sales->code = $a->KOD_AE;
            $sales->save(false);
        }
    }
}
