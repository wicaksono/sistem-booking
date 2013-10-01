<!--<pre><?php print_r($data); ?></pre>-->

<div class="row">
    <div class="col-12">
        <ul class="placing-pagination">
        <?php for($i=0; $i<$data['meta']['page']; $i++): ?>
            <li><?php echo CHtml::link($i + 1, ['placing/report', 'date' => $date, 'page' => $i], ['class' => 'btn btn-default']); ?></li>
        <?php endfor; ?>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php $materi = array(); ?>
        <?php $total_mmk_iklan = 0; ?>
        <?php $total_mmk_page = 0; ?>
        <?php foreach($pages as $key => $page): ?>
        <h3><?php echo CommPlacing::getEditionName($key); ?></h3>
        <ul class="partiture-image clearfix">
            <?php foreach($page as $pa): ?>
            <li>
                <?php foreach($pa as $p): ?>
                <?php
                    $total_mmk_page += 3780;
                    if(isset($data['dpage'][$p])) {
                        echo CHtml::image($this->createUrl('placing/render', ['data' => base64_encode(json_encode($data['dpage'][$p]))]));
                        if(isset($data['items'][$p]) && is_array($data['items'][$p])) {
                            foreach($data['items'][$p] as $item) {
                                $materi[] = $item;
                                $total_mmk_iklan += $item['sizex'] * $item['sizey'];
                            }
                        }
                    } else {
                        echo CHtml::image($this->createUrl('placing/render', ['data' => base64_encode(json_encode(['page' => $p, 'data' => []]))]));
                    }
                ?>
                <?php endforeach; ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endforeach; ?>
    </div>
</div>

<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Halaman</th>
                    <th>File</th>
                    <th>Ukuran</th>
                    <th>Warna</th>
                    <th>MMK</th>
                </tr>
            </thead>
            <tbody>
            <?php $ct = array(); ?>
            <?php
            usort($materi, function($a, $b) {
                return strnatcmp($a['page'], $b['page']);
            });
            ?>
            <?php foreach($materi as $item): ?>
                <tr>
                    <td><?php echo $item['page']; ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['sizex'] . 'x' . $item['sizey']; ?></td>
                    <td><?php echo CommBookingRequest::getColorName($item['color']); ?></td>
                    <td><?php echo $ct[] = $item['sizex'] * $item['sizey']; ?></td>
                </tr>
            <?php endforeach; ?>
                <tr>
                    <td colspan="4">TOTAL SPACE</td>
                    <td><?php echo $total_mmk_page; ?></td>
                </tr>
                <tr>
                    <td colspan="4">TOTAL SPACE IKLAN</td>
                    <td><?php echo $total_mmk_iklan; ?></td>
                </tr>
                <tr>
                    <td colspan="4">PROSENTASE IKLAN</td>
                    <td><?php echo round(100 * $total_mmk_iklan / $total_mmk_page, 2); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
