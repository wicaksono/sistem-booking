<?php

/**
 * Class PlacingController
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class PlacingController extends Controller
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
                'actions' => ['browse', 'create', 'getter', 'update']
            ),
            array(
                'allow',
                'roles'   => [UserAccount::IT, UserAccount::TF, UserAccount::AI, UserAccount::SL],
                'actions' => ['report', 'render']
            ),
            array(
                'deny',
                'users' => ['*']
            )
        );
    }

    public function actionReport($date = null, $page = 0, $ne_id = 1)
    {
        if(isset($_POST['date'])) {
            $date = $_POST['date'];
        }

        $showForm = false;

        if(is_null($date)) {
            $date = date('Y-m-d');
            $showForm = true;
        }

        if(Yii::app()->request->isAjaxRequest) {
            echo $this->createUrl('placing/report', ['date' => $date]);
            Yii::app()->end();
        }

        $data = array(
            'meta' => [],
            'dpage' => [],
            'items' => [],
        );

        $type = date('N', strtotime($date));;
        $dset = CommPlacingDateset::model()->find('date = :date', ['date' => $date]);
        if(is_object($dset)) $type = $dset->type;
        else {
            switch($type) {
                case 5: $type = 1; break;
                case 6:
                case 7: $type = 2; break;
                default: $type = 0;
            }
        }

        $cpages = CommPlacing::pages();
        $data['meta'] = $cpages[$type]['meta'];
        $pages = $cpages[$type][$page]; // @fixme validate page
        $placing = CommBookingPlacing::model()->findAll(array(
            'together' => true,
            'with' => ['br' => ['with' => ['cb']]],
            'condition' => 't.ne_id = :ne_id AND br.publish_at = :publish_at',
            'params' => [
                'ne_id' => $ne_id,
                'publish_at' => $date
            ]
        ));

        foreach($placing as $p) {
            $data['dpage'][$p->page]['page'] = $p->page;
            $data['dpage'][$p->page]['data'][] = [$p->posx, $p->posy];

            $data['items'][$p->page][] = [
                'name' => $p->br->cb->name,
                'page' => $p->page,
                'sizex' => $p->br->sizex,
                'sizey' => $p->br->sizey,
                'color' => $p->br->color
            ];
        }

//        usort($data['items'], function($a, $b) {
//            return strnatcmp($a['page'], $b['page']);
//        });

        // counter
        $data['count'] = 3780 * count($pages) * 2;

        if(!$showForm) {
            $this->setPageTitle("Report for {$date}");
            $this->render('report_body', array(
                'date' => $date,
                'page' => $page,
                'data' => $data,
                'pages' => $pages
            ));
        } else {
            $this->setPageTitle('Partitur');
            $this->render('report_head', array());
        }
    }

    public function actionGetter()
    {
        $placing = new CommBookingPlacing('getter');
        $placing->unsetAttributes();

        if(isset($_POST['CommBookingPlacing'])) {
            $placing->setAttributes($_POST['CommBookingPlacing']);
        }

        $data = base64_encode(json_encode([
            'page' => $placing->page,
            'data' => [
                [hexdec($placing->posx), hexdec($placing->posy)]
            ]
        ]));
        echo $this->createUrl('placing/render', ['size' => 14, 'data' => $data]);
    }

    public function actionRender($data, $size = 14)
    {
        if(is_null($data = json_decode(base64_decode($data), true))) {
            throw new CHttpException(500, 'Kampret Loe');
        } elseif(!is_array($data) || !isset($data['data'])) {
            throw new CHttpException(500, 'Kampret Loe');
        }

        CommPlacing::render($data, $size);
    }

    public function actionBrowse()
    {
        $placing = new CommPlacing('browse');
        $placing->unsetAttributes();

        if(isset($_GET['CommPlacing'])) {
            $placing->setAttributes($_GET['CommPlacing']);
        }

        if(Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('browse', [
                'placing' => $placing
            ], false, true);
        } else {
            $this->render('browse', [
                'placing' => $placing
            ]);
        }
    }

    public function actionCreate($ne_id, $br_id)
    {
        $placing = new CommBookingPlacing('create');
        $placing->unsetAttributes();

        // @fixme validate
        $placing->ua_id = Yii::app()->user->id;
        $placing->ne_id = (int) $ne_id;
        $placing->br_id = (int) $br_id;

        if(isset($_POST['CommBookingPlacing'])) {
            $placing->setAttributes($_POST['CommBookingPlacing']);

            if(Yii::app()->request->isAjaxRequest && $placing->save()) {
                echo CActiveForm::validate($placing);
                Yii::app()->end();
            }

            if(!Yii::app()->request->isAjaxRequest && $placing->save()) {
                $this->redirect(['placing/browse']);
                Yii::app()->end();
            }
        }

        if(isset($_POST['ajax'])) {
            echo CActiveForm::validate($placing);
            Yii::app()->end();
        }

        if(Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('create', [
                'placing' => $placing
            ], false, true);
        } else {
            $this->render('create', [
                'placing' => $placing
            ]);
        }
    }

    public function actionUpdate($ne_id, $br_id)
    {
        $placing = CommBookingPlacing::model()->findByAttributes(['ne_id' => $ne_id, 'br_id' => $br_id]);
        // @fixme ada sesuatu yang salah dengan ZEROFILL
        if(is_null($placing)) {
            //echo var_dump($ne_id);
            //throw new CHttpException(403, 'Not Found');
            //Yii::app()->end();
        }
        $placing->posx = sprintf('%02x', $placing->posx);
        $placing->posy = sprintf('%02x', $placing->posy);

        if(isset($_POST['CommBookingPlacing'])) {
            $placing->setAttributes($_POST['CommBookingPlacing']);
            $placing->ua_id = Yii::app()->user->id;

            if(Yii::app()->request->isAjaxRequest && $placing->save()) {
                echo CActiveForm::validate($placing);
                Yii::app()->end();
            }

            if(!Yii::app()->request->isAjaxRequest && $placing->save()) {
                $this->redirect(['placing/browse']);
                Yii::app()->end();
            }
        }

        if(isset($_POST['ajax'])) {
            echo CActiveForm::validate($placing);
            Yii::app()->end();
        }

        if(Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('create', [
                'placing' => $placing
            ], false, true);
        } else {
            $this->render('create', [
                'placing' => $placing
            ]);
        }
    }
}
