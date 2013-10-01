<?php

/**
 * Class CommPlacing
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class CommPlacing extends ActiveRecord {
    public $cb_id;
    public $ne_id;
    public $br_id;
    public $bp_id;

    public $cb_name;
    public $cb_username;

    public $br_stat;
    public $br_page;
    public $br_sizex;
    public $br_sizey;
    public $br_publish_at;

    public $bp_page;
    public $bp_posx;
    public $bp_posy;

    const NSNS = 0;
    const NSEB = 1;
    const NSHT = 2;
    const NSLS = 3;
    const NSIF = 4;

    const TYSK = 0;
    const TYJA = 1;
    const TYSM = 2;
    const TYB1 = 3; // jumat belanja 8 hal
    const TYB2 = 4; // jumat belanja 12 hal

    public static function pages()
    {
        return [
            static::TYSK => [
                'meta' => [
                    'size' => 40,
                    'page' => 3
                ],
                0 => [
                    static::NSNS => [
                        [16,  1], // 0
                        [2 , 15], // 1
                        [14,  3], // 2
                        [4 , 13], // 3
                        [12,  5], // 4
                        [6 , 11], // 5
                        [10,  7], // 6
                        [8 ,  9], // 7
                    ]
                ],
                1 => [
                    static::NSEB => [
                        [24, 17], // 0
                        [18, 23], // 1
                        [22, 19], // 2
                        [20, 21], // 3
                    ],
                    static::NSHT => [
                        [32, 25], // 4
                        [26, 31], // 5
                        [30, 27], // 6
                        [28, 29], // 7
                    ]
                ],
                2 => [
                    static::NSLS => [
                        [36, 33], // 0
                        [34, 35], // 1
                    ],
                    static::NSIF => [
                        [40, 37], // 2
                        [38, 39], // 3
                    ]
                ],
            ],
            static::TYJA => [
                'meta' => [
                    'page' => 3,
                    'size' => 36
                ],
                0 => [
                    static::NSNS => [
                        [16,  1], // 0
                        [2 , 15], // 1
                        [14,  3], // 2
                        [4 , 13], // 3
                        [12,  5], // 4
                        [6 , 11], // 5
                        [10,  7], // 6
                        [8 ,  9], // 7
                    ]
                ],
                1 => [
                    static::NSEB => [
                        [24, 17], // 0
                        [18, 23], // 1
                        [22, 19], // 2
                        [20, 21], // 3
                    ],
                    static::NSHT => [
                        [28, 25], // 4
                        [26, 27], // 5
                    ]
                ],
                2 => [
                    static::NSLS => [
                        [36, 29], // 0
                        [34, 35], // 1
                        [30, 31], // 2
                        [32, 33], // 3
                    ]
                ],
            ],
            static::TYSM => [
                'meta' => [
                    'page' => 2,
                    'size' => 32
                ],
                0 => [
                    static::NSNS => [
                        [16,  1], // 0
                        [2 , 15], // 1
                        [14,  3], // 2
                        [4 , 13], // 3
                        [12,  5], // 4
                        [6 , 11], // 5
                        [10,  7], // 6
                        [8 ,  9], // 7
                    ]
                ],
                1 => [
                    static::NSHT => [
                        [24, 17], // 0
                        [18, 23], // 1
                        [22, 19], // 2
                        [20, 21], // 3
                    ],
                    static::NSLS => [
                        [32, 25], // 4
                        [26, 31], // 5
                        [30, 27], // 6
                        [28, 29], // 7
                    ]
                ],
            ],
            static::TYB1 => [
                'meta' => [
                    'page' => 3,
                    'size' => 36
                ],
                0 => [
                    static::NSNS => [
                        [16,  1], // 0
                        [2 , 15], // 1
                        [14,  3], // 2
                        [4 , 13], // 3
                        [12,  5], // 4
                        [6 , 11], // 5
                        [10,  7], // 6
                        [8 ,  9], // 7
                    ]
                ],
                1 => [
                    static::NSEB => [
                        [24, 17], // 0
                        [18, 23], // 1
                        [22, 19], // 2
                        [20, 21], // 3
                    ],
                    static::NSHT => [
                        [28, 25], // 4
                        [26, 27], // 5
                    ]
                ],
                2 => [
                    static::NSLS => [
                        [36, 29], // 0
                        [34, 35], // 1
                        [30, 31], // 2
                        [32, 33], // 3
                    ]
                ],
            ],
            static::TYB2 => [
                'meta' => [
                    'page' => 3,
                    'size' => 36
                ],
                0 => [
                    static::NSNS => [
                        [16,  1], // 0
                        [2 , 15], // 1
                        [14,  3], // 2
                        [4 , 13], // 3
                        [12,  5], // 4
                        [6 , 11], // 5
                        [10,  7], // 6
                        [8 ,  9], // 7
                    ]
                ],
                1 => [
                    static::NSEB => [
                        [24, 17], // 0
                        [18, 23], // 1
                        [22, 19], // 2
                        [20, 21], // 3
                    ],
                    static::NSHT => [
                        [28, 25], // 4
                        [26, 27], // 5
                    ]
                ],
                2 => [
                    static::NSLS => [
                        [36, 29], // 0
                        [34, 35], // 1
                        [30, 31], // 2
                        [32, 33], // 3
                    ]
                ],
            ],
        ];
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'comm_placing';
    }

    public function primaryKey()
    {
        return ['ne_id', 'br_id'];
    }

    public function relations()
    {
        return array(
            'cb' => [static::BELONGS_TO, 'CommBooking', 'cb_id'],
            'ne' => [static::BELONGS_TO, 'NewsEdition', 'ne_id'],
            'br' => [static::BELONGS_TO, 'CommBookingRequest', 'br_id'],
            'bp' => [static::BELONGS_TO, 'CommBookingPlacing', 'bp_id']
        );
    }

    public function attributeLabels()
    {
        return array(
            'cb_id' => 'Booking',
            'ne_id' => 'Edisi',
            'br_id' => 'Materi',
            'bp_id' => 'Partitur',
            'cb_name' => 'Nama Iklan',
            'cb_username' => 'PIC',

            'br_stat' => 'Status Materi',
            'br_page' => 'Halaman',
            'br_sizex' => 'Kolom',
            'br_sizey' => 'Baris',
            'br_publish_at' => 'Waktu Tayang',

            'bp_page' => 'Halaman',
            'bp_posx' => 'K.Awal',
            'bp_posy' => 'K.Akhir'
        );
    }

    public function rules()
    {
        return array(
            ['cb_id,ne_id,br_id,bp_id', 'safe'],
            ['cb_name', 'safe'],
            ['cb_username', 'safe'],
            ['br_stat,br_sizex,br_sizey,br_publish_at', 'safe'],
            ['bp_page', 'safe']
        );
    }

    public function browse()
    {
        $criteria = new CDbCriteria();
        $criteria->together = true;
        $criteria->with = [
            'cb' => [
                'with' => [
                    'ua' => ['alias' => 'uac']
                ]
            ],
            'br' => [
                'with' => [
                    'ua' => ['alias' => 'uab']
                ]
            ], 'ne', 'bp'
        ];
        $criteria->compare('t.cb_id', $this->cb_id, TRUE);
        $criteria->compare('t.ne_id', $this->ne_id, TRUE);
        $criteria->compare('cb.name', $this->cb_name, TRUE);
        $criteria->compare('uac.username', $this->cb_username, TRUE);

        $criteria->compare('br.stat', $this->br_stat, TRUE);
        $criteria->compare('br.publish_at', $this->br_publish_at, TRUE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'cb_id' => array(
                        'asc'  => 't.cb_id',
                        'desc' => 't.cb_id DESC',
                    ),
                    'cb_name' => array(
                        'asc'  => 'cb.name',
                        'desc' => 'cb.name DESC',
                    ),
                    'cb_username' => array(
                        'asc'  => 'uac.username',
                        'desc' => 'uac.username DESC',
                    ),
                    'ne_id' => array(
                        'asc'  => 'ne.id',
                        'desc' => 'ne.id DESC',
                    ),
                    'br_id' => array(
                        'asc'  => 't.br_id',
                        'desc' => 't.br_id DESC',
                    ),
                    'br_stat' => array(
                        'asc'  => 'br.stat',
                        'desc' => 'br.stat DESC',
                    ),
                    'br_page' => array(
                        'asc'  => 'br.page',
                        'desc' => 'br.page DESC',
                    ),
                    'br_sizex' => array(
                        'asc'  => 'br.sizex',
                        'desc' => 'br.sizex DESC',
                    ),
                    'br_sizey' => array(
                        'asc'  => 'br.sizey',
                        'desc' => 'br.sizey DESC',
                    ),
                    'br_publish_at' => array(
                        'asc'  => 'br.publish_at',
                        'desc' => 'br.publish_at DESC',
                    ),
                    'bp_id' => array(
                        'asc'  => 't.bp_id',
                        'desc' => 't.bp_id DESC',
                    ),
                    'bp_page' => array(
                        'asc'  => 'bp.page',
                        'desc' => 'bp.page DESC',
                    ),
                    'bp_posx' => array(
                        'asc'  => 'bp.posx',
                        'desc' => 'bp.posx DESC',
                    ),
                    'bp_posy' => array(
                        'asc'  => 'bp.posy',
                        'desc' => 'bp.posy DESC',
                    ),
                ),
            ),
            'pagination' => array(
                'pageSize' => 10
            ),
        ));
    }

    public static function getEditionList()
    {
        return array(
            static::NSNS => 'News',
            static::NSEB => 'Ekonomi Bisnis',
            static::NSHT => 'Hattrick',
            static::NSLS => 'Life Style',
            static::NSIF => 'Informasiana'
        );
    }

    public static function getEditionName($edition)
    {
        foreach(static::getEditionList() as $key => $value) {
            if($key === $edition) return $value;
        }
        return 'Unknown';
    }

    public static function getTypeList()
    {
        return array(
            static::TYSK => 'Senin - Kamis',
            static::TYJA => 'Jum\'at',
            static::TYSM => 'Sabtu - Minggu',
            static::TYB1 => 'Jum\'at Belanja 8 Hal',
            static::TYB2 => 'Jum\'at Belanja 12 Hal'
        );
    }

    public static function getTypeName($type)
    {
        foreach(static::getTypeList() as $key => $value) {
            if($key == $type) return $value;
        }
        return 'Unknown';
    }

    public static function render($data, $space = 14)
    {
        $sizex = $space * 7  + 1;
        $sizey = $space * 10 + 1;
        $image = imagecreate($sizex, $sizey);

        $color = array(
            'base' => imagecolorallocate($image, 0xFF, 0xFF, 0xFF),
            'grid' => imagecolorallocate($image, 0x00, 0x00, 0x00),
            'text' => imagecolorallocate($image, 0x00, 0x00, 0x00),
            'cube' => ''
        );

        // draw background
        $x0 = $x1 = 0;
        $y0 = $y1 = 0;

        // draw cube
        foreach($data['data'] as $cube) {
            // getting coordinates
            $d0 = $cube[0];
            $d1 = $cube[1];

            $c0 = $d0 >> 4;
            $c1 = $d0 & 0x0F;
            $c2 = $d1 >> 4;
            $c3 = $d1 & 0x0F;

            $x0 = (($c0 + 0) * $space) + 1;
            $x1 = (($c2 + 1) * $space) - 1;
            $y0 = (($c1 + 0) * $space) + 1;
            $y1 = (($c3 + 1) * $space) - 1;

            $randr = rand(64, 128);
            $color['cube'] = imagecolorallocate($image, $randr, $randr, $randr);
            imagefilledrectangle($image, $x0, $y0, $x1, $y1, $color['cube']);
        }

        // draw x lines
        for($i=0; $i<8; $i++) {
            $x0 = $space * $i;
            $x1 = $x0;
            $y0 = 0;
            $y1 = $sizey;

            imageline($image, $x0, $y0, $x1, $y1, $color['grid']);
        }

        // draw y lines
        for($i=0; $i<11; $i++) {
            $x0 = 0;
            $x1 = $sizex;
            $y0 = $space * $i;
            $y1 = $y0;

            imageline($image, $x0, $y0, $x1, $y1, $color['grid']);
        }

        // draw page number
        if(isset($data['page'])) {
            $page = sprintf('%1$02d', $data['page']);
            imagestring($image, 2, 2, 0, $page, $color['text']);
        }

        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);
    }
}
