<?php
$msg_error = '';
$msg_success = '';
$field_notice = array();

if(isset($_POST['send'])){
    
    if(CAPTCHA_PKEY != '' && CAPTCHA_SKEY != ''){
        require(SYSBASE.'includes/recaptchalib.php');
    
        $secret = CAPTCHA_SKEY;
        $response = null;
        $reCaptcha = new ReCaptcha($secret);
        if(isset($_POST['g-recaptcha-response']))
            $response = $reCaptcha->verifyResponse($_SERVER['REMOTE_ADDR'], $_POST['g-recaptcha-response']);
        if($response == null || !$response->success) $field_notice['captcha'] = $texts['INVALID_CAPTCHA_CODE'];
    }
    
    $name = html_entity_decode($_POST['name'], ENT_QUOTES, 'UTF-8');
       
    $email = $_POST['email'];
    $msg = html_entity_decode($_POST['msg'], ENT_QUOTES, 'UTF-8');
    $subject = html_entity_decode($_POST['subject'], ENT_QUOTES, 'UTF-8');
    $privacy_agreement = isset($_POST['privacy_agreement']) ? true : false;

    if(!$privacy_agreement) $field_notice['privacy_agreement'] = $texts['REQUIRED_FIELD'];
    if($name == '') $field_notice['name'] = $texts['REQUIRED_FIELD'];
    if($msg == '') $field_notice['msg'] = $texts['REQUIRED_FIELD'];
    if($subject == '') $field_notice['subject'] = $texts['REQUIRED_FIELD'];
    
    if($email == '' || !preg_match('/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/i', $email)) $field_notice['email'] = $texts['INVALID_EMAIL'];
    
    if(count($field_notice) == 0){

        $data = array();
        $data['id'] = '';
        $data['name'] = $name;
        $data['email'] = $email;
        $data['subject'] = $subject;
        $data['msg'] = $msg;
        $data['add_date'] = time();
        $data['edit_date'] = null;

        $result_message = db_prepareInsert($db, 'pm_message', $data);
        $result_message->execute();
            
        $mail = getMail($db, 'CONTACT', array(
            '{name}' => $name,
            '{email}' => $email,
            '{msg}' => nl2br($msg)
        ));
        
        if($mail !== false && sendMail(EMAIL, OWNER, $subject, $mail['content'], $email, $name))
            $msg_success .= $texts['MAIL_DELIVERY_SUCCESS'];
        else
            $msg_error .= $texts['MAIL_DELIVERY_FAILURE'];
    }else
        $msg_error .= $texts['FORM_ERRORS'];
    
}else{
    $name = '';
    $email = '';
    $subject = '';
    $msg = '';
    $privacy_agreement = false;
}
require(getFromTemplate('common/header.php', false)); ?>

<script>
    var locations = [
        <?php
        $result_location = $db->query("SELECT * FROM pm_location WHERE checked = 1 AND pages REGEXP '(^|,)".$page_id."(,|$)'");
        if($result_location !== false){
            $nb_locations = $db->last_row_count();
            foreach($result_location as $i => $row){
                $location_name = $row['name'];
                $location_address = $row['address'];
                $location_lat = $row['lat'];
                $location_lng = $row['lng'];

                echo "['".addslashes($location_name)."', '".addslashes($location_address)."', '".$location_lat."', '".$location_lng."']";
                if($i+1 < $nb_locations) echo ",\n";
            }
        } ?>
    ];
</script>

<div id="wrapper">
                <!-- content-->
                <div class="content">
                    <!-- map-view-wrap --> 
                    <div class="map-view-wrap">
                        <div class="container">
                            <div class="map-view-wrap_item">
                                <div class="list-single-main-item-title fl-wrap">
                                    <h3>İletişim</h3>
                                </div>
                                <div class="box-widget-list mar-top">
                                    <ul>
                                        <li><span><i class="fal fa-map-marker"></i> Adres :</span> <a href="#">İstanbul/Türkiye</a></li>
                                        <li><span><i class="fal fa-phone"></i> Telefon :</span> <a href="#">212 123 45 67</a></li>
                                        <li><span><i class="fal fa-envelope"></i> E-Mail :</span> <a href="#">info@kursarabul.com</a></li>
                                        <li><span><i class="fal fa-browser"></i> Website :</span> <a href="#">kursarabul.com</a></li>
                                    </ul>
                                </div>
                                <div class="list-widget-social">
                                    <ul>
                                        <li><a href="#" target="_blank" ><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#" target="_blank" ><i class="fab fa-vk"></i></a></li>
                                        <li><a href="#" target="_blank" ><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--map-view-wrap end --> 
                    <!-- Map -->
                    <div class="map-container fw-map2" style="background-color:lightsteelblue;">
                        
                        <!-- <div id="singleMap" data-latitude="40.7427837" data-longitude="-73.11445617675781"></div> -->
                    </div>
                    <!-- Map end --> 
                    <div class="breadcrumbs-fs fl-wrap">
                        <div class="container">
                            <div class="breadcrumbs fl-wrap"><a href="/">Anasayfa</a><span>İletişim</span></div>
                        </div>
                    </div>
                    <section  id="sec1" class="grey-b lue-bg middle-padding">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <!--   list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Hakkımızda </h3>
                                        </div>
                                        <div class="list-single-main-media fl-wrap">
                                            <img src="/templates/default/images/educaiton.png" alt="" class="respimg">
                                        </div>
                                        <p>Türkiye'de  yer alan tüm eğitim seviyelerine ait kurs merkezlerini, öğrencilerin kaliteli bir eğitim alması amacıyla sizin için tarafsız şekilde listeleme hizmeti sunan bir eğitim platformuyuz.   </p>
                                        <div class="list-single-main-item-title fl-wrap mar-top">
                                            <h3>Çalışma Saatleri </h3>
                                        </div>
                                        <ul class="cat-item">
                                            <li><a href="#">Pzt - Cuma</a> <span>08.00 - 18.00</span></li>
                                            <li><a href="#">Cts - Pzr </a> <span>10.00 - 15.00</span></li>
                                        </ul>
                                    </div>
                                    <!--   list-single-main-item end -->
                                </div>
                                <div class="col-md-8">
                                    <div class="list-single-main-item fl-wrap">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Bize Ulaşın</h3>
                                        </div>
                                        <div id="contact-form">
                                            <div id="message"></div>
                                            <form  class="custom-form" method="post" action="<?php echo DOCBASE.$page['alias']; ?>">
                                                <fieldset>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label><i class="fal fa-user"></i></label>
                                                        <input type="text" class="form-control" name="name" value="<?php echo htmlentities($name, ENT_QUOTES, 'UTF-8'); ?>" placeholder="<?php echo $texts['FIRSTNAME']." ".$texts['LASTNAME']; ?> *">
                                                    </div>
                                                    <div class="field-notice" rel="name"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label><i class="fal fa-envelope"></i>  </label>
                                                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $texts['EMAIL']; ?> *">
                                                    </div>
                                                    <div class="field-notice" rel="email"></div>
                                                </div>
                                           
                                            <div class="form-group">
                                                    <div class="input-group">
                                                        <label><i class="fal fa-envelope"></i>  </label>
                                                        <input type="text" class="form-control" name="subject" value="<?php echo $subject; ?>" placeholder="<?php echo $texts['SUBJECT']; ?> *">
                                                    </div>
                                                    <div class="field-notice" rel="subject"></div>
                                            </div>
                                            <div class="field-notice" rel="subject"></div>
                                            
                                                <div class="form-group">
                                                    <div class="input-group">
                                                    <textarea class="form-control" name="msg" placeholder="<?php echo $texts['MESSAGE']; ?> *" rows="4"><?php echo htmlentities($msg, ENT_QUOTES, 'UTF-8'); ?></textarea>
                                                    </div>
                                                    <div class="field-notice" rel="msg"></div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="checkbox" name="privacy_agreement" value="1"<?php if($privacy_agreement) echo ' checked="checked"'; ?>> <?php echo $texts['PRIVACY_POLICY_AGREEMENT']; ?>
                                                    <div class="field-notice" rel="privacy_agreement"></div>
                                                </div>
                                                
                                                </fieldset>
                                                </div>
                                                <button type="submit" class="btn color-bg" name="send"><i class="fas fa-fw fa-paper-plane"></i>Gönder<i class="fal fa-angle-right"></i></button>
                                            </form>
                                        </div>
                                        <!-- contact form  end--> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-decor"></div>
                    </section>
                    <!-- section end -->
                </div>
                <!-- content end-->
            </div>