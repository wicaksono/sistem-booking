<?php

/**
 * Class CompanyController
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class CompanyController extends Controller
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
                'roles'   => [UserAccount::IT, UserAccount::TF, UserAccount::AI],
                'actions' => ['browse']
            ),
            array(
                'allow',
                'roles'   => [UserAccount::IT],
                'actions' => ['manage', 'relate']
            ),
            array(
                'deny',
                'users' => ['*']
            )
        );
    }

    public function actionBrowse()
    {
        $query = null;
        if(isset($_GET['query'])) {
            $query = $_GET['query'];
        }

        $criteria = new CDbCriteria();
        $criteria->condition = 'name LIKE :name';
        $criteria->params = ['name' => "%$query%"];
        $criteria->limit = 10;
        $company = CommMigrateCompany::model()->findAll($criteria);

        $result = array();
        foreach($company as $i => $c) {
            $result[$i]['name'] = $c->name;
            $result[$i]['code'] = $c->code;
            $result[$i]['value'] = $c->id;
        }

        header('Content-type: application/json');
        echo json_encode($result);
    }

    public function actionManage()
    {}

    public function actionRelate()
    {
        set_time_limit(0);

        $counter = 0;
        $eCusts = DataOutsideCompany::model()->findAll();
        $sCusts = CHtml::listData(CommMigrateCompany::model()->findAll(), 'code', 'name');

        foreach($eCusts as $eCust) {
            if(!array_key_exists($eCust->CUSTCODE, $sCusts)) {
                $company = new CommMigrateCompany();
                $company->code = $eCust->CUSTCODE;
                $company->name = $eCust->CUSNAME;
                $company->save(FALSE);
                $counter++;
            }
        }

        echo $counter;
    }
}
