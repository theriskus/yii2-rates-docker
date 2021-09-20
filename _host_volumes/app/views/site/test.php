<?php
/** @var array $codes */

use yii\helpers\Html;

$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;
?>
<select id="selector" class="form-control">
    <?php
    foreach ($codes as $code) {
        echo '<option value="' . $code['charcode'] . '">' . $code['charcode'] . '</option>';
    }
    ?>
</select>
<pre>
    <div class="test-view"></div>
</pre>
<?php
$this->registerJs(
    <<<JS
    var token = '';
    function update(valute) {
        let url = 'http://localhost:8100/rate?valute='+valute;
        $.ajax({
          type: "POST",
          url: 'http://localhost:8100/auth?username=admin&password=admin',
          success: function(da) {
            token = da.token;
            $.ajax({
                type: "GET",
                url: url,
                headers: {
                    "token": da.token
                },
                success: function(da) {
                    $(".test-view").html(JSON.stringify(da));
                },  
                dataType: 'json'
            });
          },
          dataType: 'json'
      });
    }
    $('#selector').change(function () {
        update($(this).val());
    })
JS
    , yii\web\View::POS_READY);
?>
