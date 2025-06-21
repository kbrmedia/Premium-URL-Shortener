<?php
/**
 * =======================================================================================
 *                           GemFramework (c) GemPixel
 * ---------------------------------------------------------------------------------------
 *  This software is packaged with an exclusive framework as such distribution
 *  or modification of this framework is not allowed before prior consent from
 *  GemPixel. If you find that this framework is packaged in a software not distributed
 *  by GemPixel or authorized parties, you must not use this software and contact GemPixel
 *  at https://gempixel.com/contact to inform them of this misuse.
 * =======================================================================================
 *
 * @package GemPixel\Premium-URL-Shortener
 * @author GemPixel (https://gempixel.com)
 * @license https://gempixel.com/licenses
 * @link https://gempixel.com
 */

use Core\Request;
use Core\View;
use Core\Helper;
use Core\DB;

class Update {
    /**
     * Latest Version
     *
     * @author GemPixel <https://gempixel.com>
     */
    private $latest = "7.6.4";

    /**
     * Constructor
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.0
     */
    public function __construct(){

        if(config('version')){
            $request  = request();

            \Core\Auth::check();

            $user = \Core\Auth::user();

            if(!$request->privatekey && !$user){
                return GemError::trigger(403);
            }

            if(!$request->privatekey && !$user->admin){
                return GemError::trigger(403);
            }

            if($request->privatekey && $request->privatekey != md5('update.'.AuthToken)){
                return GemError::trigger(403);
            }
        }
    }
    /**
     * Run Updater
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.0
     * @return void
     */
    public function index(Request $request){

        if($request->update){
            return $this->processUpdate();
        }

        $this->header($request);
        echo '<h2>Premium URL Shortener Updater</h2>';
        if(version_compare(config('version'), $this->latest) == 0){
            echo '<p>Your current version (<strong>'.config('version').'</strong>) is the same as the latest version (<strong>'.$this->latest.'</strong>) of the script. If the update is not working as expected, run <a href="?update=true&advanced=true">Advanced Updater</a> to check the database for all previous updates. The advanced updater will check all previous updates requirements and update the database accordingly. The advanced updater might timeout if you have a very large database.
            </p>

            <p><a href="?update=true&advanced=true" class="button"><span>Advanced Updater</span> <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/></svg></a></p>';
        } else {
            echo '<p>
            You are about to upgrade this software from version <strong>'.config('version').'</strong> to version <strong>'.$this->latest.'</strong>. Please note that this will only update your database only. It is strongly recommended that you first backup your database so you can rollback in case you have issues with the current version.
            </p>';
            echo '
            <p>
                If your current version is the same as the latest version and you are experiencing issues, you can still run this update to make sure changes are applied correctly. If this does not fix your issue, please contact us by <a href="https://support.gempixel.com/" target="_blank">opening a ticket</a> and provide us all the necessary information.
            </p>

            <p>
                The updater will only updates elements prior to your current version. If the update is not working as expected? Run <a href="?update=true&advanced=true">Advanced Updater</a> to check database for all updates.
            </p>

            <p><a href="?update=true" class="button"><span>Update</span> <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/></svg></a></p>';
        }
        $this->footer();
    }

    /**
     * Header
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.0
     * @return void
     */
    private function header($request){
        echo '<!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
                <title>Premium URL Shortener Updater</title>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

                <style type="text/css">
                    '.$this->css().'
                </style>
            </head>
            <body>
                <div class="container">
                    <ul class="progress">
                        <li class="current">Information</li>
                        <li>Complete</li>
                    </ul>
                    <div class="card">';
    }
    /**
     * Footer
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.0
     * @return void
     */
    private function footer(){
                echo '</div>
                    <div class="footer">
                        '.date("Y").' &copy; <a href="https://gempixel.com" target="_blank">GemPixel</a> - All Rights Reserved.
                        <div class="float-right">
                            <a href="https://gempixel.com/" target="_blank">Home</a>
                            <a href="https://gempixel.com/products" target="_blank">Products</a>
                            <a href="https://support.gempixel.com/" target="_blank">Support</a>
                        </div>
                    </div>
                </div>
            </body>
        </html>';
    }
    /**
     * Process Update
     *
     * @author GemPixel <https://gempixel.com>
     * @version 1.0
     * @return void
     */
    private function processUpdate(){

        $version = config('version');

        $advanced = request()->advanced;

        try{

            if(!$version || $advanced || version_compare($version, '6.1') < 0) {
                $this->update();
            }
            if(!$version || $advanced || version_compare($version, '6.3') < 0) {
                $this->update63();
            }
            if(!$version || $advanced || version_compare($version, '6.4') < 0) {
                $this->update64();
            }
            if(!$version || $advanced || version_compare($version, '6.5') < 0) {
                $this->update65();
            }
            if(!$version || $advanced || version_compare($version, '6.6') < 0) {
                $this->update66();
            }
            if(!$version || $advanced || version_compare($version, '6.7') < 0) {
                $this->update67();
            }
            if(!$version || $advanced || version_compare($version, '6.8') < 0) {
                $this->update68();
            }
            if(!$version || $advanced || version_compare($version, '6.8.3') < 0) {
                $this->update683();
            }
            if(!$version || $advanced || version_compare($version, '7.0') < 0) {
                $this->update70();
            }
            if(!$version || $advanced || version_compare($version, '7.2') < 0) {
                $this->update72();
            }
            if(!$version || $advanced || version_compare($version, '7.3') < 0) {
                $this->update73();
            }
            if(!$version || $advanced || version_compare($version, '7.3.2') < 0) {
                $this->update732();
            }
            if(!$version || $advanced || version_compare($version, '7.4.3') < 0) {
                $this->update743();
            }
            if(!$version || $advanced || version_compare($version, '7.5') < 0) {
                $this->update75();
            }
            if(!$version || $advanced || version_compare($version, '7.6') < 0) {
                $this->update751();
            }

            if(!$version || $advanced || version_compare($version, '7.6') < 0) {
                $this->update76();
            }

            if(!$version || $advanced || version_compare($version, '7.6.1') < 0) {
                $this->update761();
            }

            if(!$version || $advanced || version_compare($version, '7.6.2') < 0) {
                $this->update762();
            }
            
            if(!$version || $advanced || version_compare($version, '7.6.4') < 0) {
                $this->update764();
            }

            $this->updateversion();

            if(!$version || $advanced || version_compare($version, '6.1') < 0) {
                $this->migratepixels();
            }

            $this->extracorrections();

        }catch(\Exception $e){

            GemError::log($e->getMessage(), [], 'Update');

            return \Core\Helper::redirect()->to(route('admin'))->with('success', 'Updated was completed with an error. Please contact us if you experience issues.');
        }

        if($advanced){
            return \Core\Helper::redirect()->to(route('admin'))->with('success', 'Advanced Updater was successfully executed.');
        }
        return \Core\Helper::redirect()->to(route('admin'))->with('success', 'Updated was successfully completed.');
    }
    /**
     * Update 7.6.4
     *
     * @author GemPixel <https://gempixel.com> 
     * @version 7.6.4
     * @return void
     */
    private function update764(){

        $allConfig = config();

        if(!isset($allConfig->sitename)){
            $query = DB::settings()->create();
            $query->config = 'sitename';
            $query->var = explode(' ', $allConfig->title)[0];
            $query->save();
        }
        DB::schema('withdrawals', function($table) {
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->bigint('user_id')->index();
            $table->string('amount', 191);
            $table->string('paypal', 191);
            $table->string('status', 191, 'pending');
            $table->text('note');
            $table->timestamp('created_at');
            $table->datetime('processed_at', null);
        });

        DB::schema('qrtemplates', function($table) {
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->string('name', 191);
            $table->text('description');
            $table->text('data');
            $table->string('filename', 191);
            $table->int('paidonly', null, '0');
            $table->int('status', null, '1');
            $table->timestamp('created_at');
        });
    }
    /**
     * Update 7.6.2
     *
     * @author GemPixel <https://gempixel.com> 
     * @version 7.6.2
     * @return void
     */
    private function update762(){

        if(DB::columnExists('plans', 'ispopular') === false){
            DB::alter('plans', function($table){
                $table->add()->int('ispopular', null, '0');
            });
        }
    }  
    /**
     * Update 7.6.1
     *
     * @author GemPixel <https://gempixel.com> 
     * @version 7.6.1
     * @return void
     */
    private function update761(){

        $allConfig = config();

        if(!isset($allConfig->imagemagick)){
            $query = DB::settings()->create();
            $query->config = 'imagemagick';
            $query->var = class_exists('Imagick', false);
            $query->save();
        }
    }
    /**
     * Update 7.6
     *
     * @author GemPixel <https://gempixel.com> 
     * @version 7.6
     * @return void
     */
    private function update76(){


        DB::schema('oauth_clients', function($table) {
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->bigint('user_id')->index();
            $table->string('name', 191);
            $table->string('client_id', 80)->unique();
            $table->string('client_secret', 100);
            $table->text('redirect_uri');
            $table->timestamp('created_at');
        });

        DB::schema('oauth_access_tokens', function($table) {
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->bigint('user_id')->index();
            $table->integer('client_id');
            $table->string('name', 191);
            $table->string('code', 191);
            $table->string('token', 191);
            $table->text('scopes');
            $table->timestamp('created_at');
            $table->timestamp('expires_at', null);
        });

        DB::schema('apikeys', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->bigint('userid')->index();
            $table->string('apikey',  191, null)->index();
            $table->string('description',  191, null);
            $table->text('permissions');
            $table->timestamp('created_at');
        });

        $allConfig = config();

        if(!isset($allConfig->sizes)){
            $query = DB::settings()->create();
            $query->config = 'sizes';
            $query->var = json_encode(['avatar' => 500,'bio' => ['avatar' => 500,'background' => 1024,'image' => 500,'link' => 500, 'banner' => 1024],'splash' => ['avatar' => 500,'banner' => 1024,],'qrfile' => 2048,'qrcsv' => 1024]);
            $query->save();
        }

        if(!isset($allConfig->extensions)){
            $query = DB::settings()->create();
            $query->config = 'extensions';
            $query->var = json_encode(['avatar' => implode(',', ['jpg', 'png', 'jpeg']),'bio' => ['avatar' => implode(',', ['jpg', 'png', 'jpeg']),'background' => implode(',',['jpg', 'png', 'jpeg']),'image' => implode(',',['jpg', 'png', 'jpeg']),'link' => implode(',',['jpg', 'png', 'jpeg', 'gif']), 'banner' => implode(',', ['jpg', 'png', 'jpeg'])],'splash' => ['avatar' => implode(',',['jpg', 'png', 'jpeg', 'gif']),'banner' => implode(',',['jpg', 'png', 'jpeg'])]]);
            $query->save();
        }
    }
    /**
     * Update 7.5.1
     *
     * @author GemPixel <https://gempixel.com> 
     * @version 7.5.1
     * @return void
     */
    private function update751(){

        if(DB::columnExists('plans', 'qrcounttype') === false){
            DB::alter('plans', function($table){
                $table->add()->string('qrcounttype', 191, 'total');
            });
        }
    }
    /**
     * Update 7.5
     *
     * @author GemPixel <https://gempixel.com> 
     * @version 7.5
     * @return void
     */
    private function update75(){

        $allConfig = config();

        if(!isset($allConfig->verifylink)){
            $query = DB::settings()->create();
            $query->config = 'verifylink';
            $query->var = '0';
            $query->save();
        }
    }    
    /**
     * Update 7.4.3
     *
     * @author GemPixel <https://gempixel.com>
     * @version 7.4.3
     * @return void
     */
    private function update743(){

        DB::schema('appevents', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->bigint('userid')->index();
            $table->bigint('planid')->index();
            $table->string('type',  191, null)->index();
            $table->string('handler', 191, null);
            $table->text('data');
            $table->int("status", null, '0');
            $table->timestamp('created_at');
            $table->timestamp('expires_at', null);
        });

        $allConfig = config();

        if(isset($allConfig->news) && $config = DB::settings()->where('config', 'news')->first()){
            $config->delete();
        }

        if(!isset($allConfig->userlogging)){
            $query = DB::settings()->create();
            $query->config = 'userlogging';
            $query->var = '0';
            $query->save();
        }

        if(!isset($allConfig->bio)){
            $query = DB::settings()->create();
            $query->config = 'bio';
            $query->var = json_encode(['blocked' => []]);
            $query->save();
        }
    }

    /**
     * Update 7.3.2
     *
     * @author GemPixel <https://gempixel.com>
     * @version 7.3.2
     * @return void
     */
    private function update732(){
        if(DB::columnExists('domains', 'bioid') === false){
            DB::alter('domains', function($table){
                $table->add()->bigint('bioid');
            });
        }
    }
    /**
     * Update 7.3
     *
     * @author GemPixel <https://gempixel.com>
     * @version 7.3
     * @return void
     */
    private function update73(){

        $allConfig = config();

        if(!isset($allConfig->publicqr)){
            $query = DB::settings()->create();
            $query->config = 'publicqr';
            $query->var = '0';
            $query->save();
        }
        if(!isset($allConfig->qrlogo)){
            $query = DB::settings()->create();
            $query->config = 'qrlogo';
            $query->var = '';
            try{
                $query->save();
            }catch(\Exception $e){

            }
        }
    }
    /**
     * Update 7.2
     *
     * @author GemPixel <https://gempixel.com>
     * @version 7.2
     * @return void
     */
    private function update72(){

        if(DB::columnExists('bundle', 'domain') === false){
            DB::alter('bundle', function($table){
                $table->add()->string('domain', 191, null);
            });
        }

        if(DB::columnExists('plans', 'counttype') === false){
            DB::alter('plans', function($table){
                $table->add()->string('counttype', 191, 'total');
            });
        }

        if(file_exists(ROOT.'/storage/themes/default/gates/profile_preview.php')) unlink(ROOT.'/storage/themes/default/gates/profile_preview.php');
        if(file_exists(ROOT.'/storage/themes/the23/gates/profile_preview.php')) unlink(ROOT.'/storage/themes/the23/gates/profile_preview.php');
        if(file_exists(ROOT.'/storage/themes/the23/gates/profile.php')) unlink(ROOT.'/storage/themes/the23/gates/profile.php');
    }
    /**
     * Update 7.0
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.9.3
     * @return void
     */
    private function update70(){

        $allConfig = config();

        if(!isset($allConfig->altlogo)){
            $query = DB::settings()->create();
            $query->config = 'altlogo';
            $query->var = '';
            $query->save();
        }

        if(!isset($allConfig->customplan)){
            $query = DB::settings()->create();
            $query->config = 'customplan';
            $query->var = '1';
            $query->save();
        }

        if(!isset($allConfig->system_registration)){
            $query = DB::settings()->create();
            $query->config = 'system_registration';
            $query->var = '1';
            $query->save();
        }

        DB::schema('themes', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->string("name", 191, null)->index();
            $table->string("description", 191, null)->index();
            $table->text("data");
            $table->int("paidonly", null, '0');
            $table->int("status", null, '0');
            $table->timestamp('created_at');
        });
        if(DB::columnExists('plans', 'hidden') === false){
            DB::alter('plans', function($table){
                $table->add()->int('hidden', 1, '0');
            });
        }

    }
    /**
     * Update 6.8.3
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.8.3
     * @return void
     */
    private function update683(){
        DB::alter('url', function($table){
            $table->change('bundle')->bigint('bundle');
        });
    }
    /**
     * Update 6.8
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.8
     * @return void
     */
    private function update68(){

        DB::schema('members', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->bigint('teamid')->index();
            $table->bigint('userid')->index();
            $table->string("token", 191, null)->index();
            $table->text("permission");
            $table->int("status", null, '0');
            $table->timestamp('created_at');
        });

        DB::schema('imports', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->bigint('userid')->index();
            $table->string("filename");
            $table->text("data");
            $table->int("processed", null, '0');
            $table->int("status", null, '0');
            $table->timestamp('created_at');
        });

        $allConfig = config();

        if(!isset($allConfig->gravatar)){
            $query = DB::settings()->create();
            $query->config = 'gravatar';
            $query->var = '1';
            $query->save();
        }

        if(DB::columnExists('user', 'slackteamid') === false){
            DB::alter('user', function($table){
                $table->add()->string('slackteamid', 191, null);
            });
        }

        $this->migrateTeams();

    }
    /**
     * Update 6.7
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.7
     * @return void
     */
    private function update67(){

        DB::schema('vouchers', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->string('name');
            $table->text('description');
            $table->string('code')->index();
            $table->integer('planid', null, '0');
            $table->integer('used', null, '0');
            $table->integer('maxuse', null, '0');
            $table->timestamp('validuntil', null);
            $table->string('period', 15, null);
            $table->timestamp('created_at');
        });

        DB::alter('ads', function($table){
            $table->change('type')->string('type');
        });

        DB::schema('postcategories', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->string("name");
            $table->string("slug")->index();
            $table->string("icon");
            $table->string("color", 6);
            $table->string("lang", 10, 'en');
            $table->text("description");
            $table->int("status", null, '1');
            $table->timestamp('created_at');
        });

        if(DB::columnExists('posts', 'userid') === false){
            DB::alter('posts', function($table){
                $table->add()->integer('userid', null, '1')->index();
            });
        }

        if(DB::columnExists('posts', 'categoryid') === false){
            DB::alter('posts', function($table){
                $table->add()->integer('categoryid', null)->index();
            });
        }

        if(DB::columnExists('posts', 'lang') === false){
            DB::alter('posts', function($table){
                $table->add()->string('lang', 10, 'en');
            });
        }

        if(DB::columnExists('faqs', 'views') === false){
            DB::alter('faqs', function($table){
                $table->add()->integer('views', null, '0');
            });
        }

        if(DB::columnExists('faqs', 'lang') === false){
            DB::alter('faqs', function($table){
                $table->add()->string('lang', 10, 'en');
            });
        }

        if(DB::columnExists('page', 'metadata') === false){
            DB::alter('page', function($table){
                $table->add()->text('metadata');
            });
        }

        if(DB::columnExists('page', 'lang') === false){
            DB::alter('page', function($table){
                $table->add()->string('lang', 10, 'en');
            });
        }

        $allConfig = config();

        if(!isset($allConfig->helpcenter)){
            $query = DB::settings()->create();
            $query->config = 'helpcenter';
            $query->var = '1';
            $query->save();
        }

        if(!isset($allConfig->cdn)){
            $query = DB::settings()->create();
            $query->config = 'cdn';
            $query->var = json_encode(['enabled' => false, 'provider' => null, 'key' => null, 'secret' => null, 'region' => null, 'bucket' => null, 'url' => null]);
            $query->save();
        }
    }
    /**
     * Update 6.6
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.6
     * @return void
     */
    private function update66(){

        $allConfig = config();

        if(!isset($allConfig->verification)){
            $query = DB::settings()->create();
            $query->config = 'verification';
            $query->var = '1';
            $query->save();
        }
    }
    /**
     * Update to 6.5
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.5
     * @return void
     */
    private function update65(){

        if(DB::columnExists('user', 'verified') === false){
            DB::alter('user', function($table){
                $table->add()->int('verified', null, '0');
            });
        }

        if(DB::columnExists('coupons', 'maxuse') === false){
            DB::alter('coupons', function($table){
                $table->add()->integer('maxuse', null, '0');
            });
        }

        if(DB::columnExists('url', 'options') === false){
            DB::alter('url', function($table){
                $table->add()->text('options', null);
            });
        }

        DB::schema('verification', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->bigint('userid')->index();
            $table->string("file");
            $table->int("status", null, '0');
            $table->timestamp('created_at');
        });
    }
    /**
     * Update to 6.4
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.4
     * @return void
     */
    private function update64(){

        DB::schema('channels', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->bigint('userid')->index();
            $table->string("name");
            $table->string("description");
            $table->string("color");
            $table->int("starred", null, '0');
            $table->timestamp('created_at');
        });

        DB::schema('tochannels', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->bigint('userid')->index();
            $table->bigint('itemid')->index();
            $table->bigint('channelid')->index();
            $table->string("type", 255, 'links');
            $table->timestamp('created_at');
        });
    }
    /**
     * Update to 6.3
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.3
     * @return void
     */
    private function update63(){

        $allConfig = config();

        if(!isset($allConfig->deepl)){
            $query = DB::settings()->create();
            $query->config = 'deepl';
            $query->var = json_encode(['enabled' => 0, 'key' => '', 'limit' => '']);
            $query->save();
        }

        if(DB::columnExists('profiles', 'responses') === false){
            DB::alter('profiles', function($table){
                $table->add()->text('responses');
            });
        }
    }

    /**
     * Update to 6.X
     *
     * @author GemPixel <https://gempixel.com>
     * @version 1.0
     * @return void
     */
    private function update(){

        DB::schema('taxrates', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->string("name");
            $table->double('rate', '10,2');
            $table->int('exclusive', '1', '1');
            $table->text('countries');
            $table->text('data');
            $table->int("status", null, '0');
        });

        $allConfig = config();

        if(!isset($allConfig->sociallinks)){
            $query = DB::settings()->create();
            $query->config = 'sociallinks';
            $query->var = json_encode(['linkedin' => '', 'instagram' => '']);
            $query->save();
        }

        if(DB::columnExists('user', 'defaultbio') === false){
            DB::alter('user', function($table){
                $table->add()->bigint('defaultbio');
            });
        }

        if(!isset($allConfig->version)){
            $query = DB::settings()->where('config', 'theme')->first();
            $query->var = 'default';
            $query->save();

            $file = file_get_contents(ROOT.'/config.php');

            $file = str_replace("__ENC__", \Defuse\Crypto\Key::createNewRandomKey()->saveToAsciiSafeString(), $file);

            $fh = fopen(ROOT.'/config.php', 'w') or die("Can't open config.php. Make sure it is writable.");

            fwrite($fh, $file);
            fclose($fh);
        }

        DB::alter('page', function($table){
            if(DB::columnExists('page', 'lastupdated') === false){
                $table->add()->timestamp('lastupdated');
            }
            if(DB::columnExists('page', 'category') === false){
                $table->add()->string('category');
            }
        });

        DB::schema('affiliates', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->integer("refid")->index();
            $table->integer("userid")->index();
            $table->double('amount', '10,2');
            $table->timestamp('referred_on');
            $table->timestamp('paid_on', null);
            $table->integer("status", null, '0');
        });
        DB::schema('faqs', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->string('slug')->index();
            $table->string('category')->index();
            $table->text('question');
            $table->text('answer');
            $table->int('pricing', null, '0');
            $table->timestamp('created_at');
        });

        $this->importFaqs();

        DB::schema('pixels', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->bigint('userid')->index();
            $table->string('type')->index();
            $table->string('name');
            $table->text('tag');
            $table->timestamp('created_at');
        });
        DB::schema('profiles', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->bigint('userid')->index();
            $table->string('alias')->index();
            $table->string('name');
            $table->bigint('urlid')->index();
            $table->text('data');
            $table->text('responses');
            $table->int('status', null, '1');
            $table->timestamp('created_at');
        });

        DB::schema('qrs', function($table){
            $table->charset("utf8mb4");
            $table->increment('id');
            $table->bigint('userid')->index();
            $table->string('alias')->index();
            $table->string('name');
            $table->string('filename');
            $table->bigint('urlid')->index();
            $table->text('data');
            $table->int('status', null, 1);
            $table->timestamp('created_at');
        });

        DB::alter('stats', function($table){
            if(DB::columnExists('stats', 'city') === false){
                $table->add()->string('city')->index();
            }
            if(DB::columnExists('stats', 'language') === false){
                $table->add()->string('language')->index();
            }
            if(DB::hasIndex('stats', 'browser') === false){
                $table->change('browser')->string('browser')->index();
            }
            if(DB::hasIndex('stats', 'os') === false){
                $table->change('os')->string('os')->index();
            }
        });

        DB::alter('url', function($table){
            if(DB::columnExists('url', 'qrid') === false){
                $table->add()->bigint('qrid');
            }
            if(DB::columnExists('url', 'profileid') === false){
                $table->add()->bigint('profileid');
            }
            if(DB::columnExists('url', 'meta_image') === false){
                $table->add()->string('meta_image');
            }
        });

        DB::alter('user', function($table){
            if(DB::columnExists('user', 'newsletter') === false){
                $table->add()->int('newsletter');
            }
            if(DB::columnExists('user', 'uniquetoken') === false){
                $table->add()->string('uniquetoken');
            }
            if(DB::columnExists('user', 'paypal') === false){
                $table->add()->string('paypal');
            }
            if(DB::columnExists('user', 'pendingpayment') === false){
                $table->add()->double('pendingpayment', '10,2');
            }
        });

        DB::alter('plans', function($table){
            if(DB::columnExists('plans', 'retention') === false){
                $table->add()->integer('retention');
            }
            if(DB::columnExists('plans', 'data') === false){
                $table->add()->text('data');
            }
            if(DB::columnExists('plans', 'price_lifetime') === false){
                $table->add()->double('price_lifetime', '10,2');
            }
        });


        $settings = ['plugins' => '{}', 'testimonials' => '[]', 'invoice' => '{"header":"","footer":""}','virustotal' => '{"key":"","limit":"2"}','affiliate' => '{"enabled":"0","rate":"30","payout":"10","terms":"terms of affiliate"}','cookieconsent' => '{"enabled":"0","message":"","link":""}'];

        \Models\Settings::updateSettings();

        $allConfig = config();

        foreach($settings as $config => $var){
            if(isset($allConfig->{$config})) continue;
            $query = DB::settings()->create();
            $query->config = $config;
            $query->var = $var;
            $query->save();
        }

    }
    /**
     * Update Version to Latest
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.0
     * @return void
     */
    private function updateversion(){
        $allConfig = config();

        if(!isset($allConfig->version)){
            $query = DB::settings()->create();
            $query->config = 'version';
        } else{
            $query = DB::settings()->where('config', 'version')->first();
        }
        $query->var = $this->latest;
        $query->save();

        \Models\Settings::updateSettings();
    }
    /**
     * Extra Corrections
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.7
     * @return void
     */
    public function extracorrections(){

        if(\Helpers\App::possible()){

            if(DB::columnExists('subscription', 'coupon') === false){
                DB::alter('subscription', function($table){
                    $table->bigint('coupon');
                });
            } else {
                DB::alter('subscription', function($table){
                    $table->change('coupon')->bigint('coupon');
                });
            }
        }
    }
    /**
     * FAQs
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.0
     * @return void
     */
    public function importFaqs(){

        $categories = '{"affiliate":{"title":"Affiliate","description":"Questions and answers about our affiliate program."},"pixels":{"title":"Pixels","description":"Pixels are great. Learn how to use to them."},"subscription":{"title":"Subscription","description":"Everything you need to know about your subscription."}}';

        $faqs = [
            ['slug' => 'google-tag-manager-pixel','category' => 'pixels','question' => 'Google Tag Manager Pixel','answer' => '<p>Google Tag Manager allows you to combine hundreds of pixels into a single pixel. Please make sure to add the correct &quot;Container ID&quot; otherwise events will not be tracked!</p><p><code>e.g. GTM-ABC123DE</code></p><p><a href="https://marketingplatform.google.com/about/tag-manager/" target="_blank">Learn more</a></p>','pricing' => '0'],

            ['slug' => 'facebook-pixel','category' => 'pixels','question' => 'Facebook Pixel','answer' => '<p>Facebook pixel makes conversion tracking, optimization and remarketing easier than ever. The Facebook pixel ID is usually composed of 16 digits. Please make sure to add the correct value otherwise events will not be tracked!</p> <p><code>e.g. 1234567890123456</code></p><p><a href="https://www.facebook.com/business/a/facebook-pixel" target="_blank">Learn more</a></p>','pricing' => '0'],

            ['slug' => 'google-adwords-conversion-pixel','category' => 'pixels','question' => 'Google Adwords Conversion Pixel','answer' => '<p>With AdWords conversion tracking, you can see how effectively your ad clicks lead to valuable customer activity. The Adwords pixel ID is usually composed of AW followed by 11 digits followed by 19 mixed characters. Please make sure to add the correct value otherwise events will not be tracked!</p><p><code>e.g. AW-12345678901/ABCDEFGHIJKLMOPQRST</code></p><p><a href="https://support.google.com/adwords/answer/1722054?hl=en" target="_blank">Learn more</a></p>','pricing' => '0'],

            ['slug' => 'linkedin-insight-pixel','category' => 'pixels','question' => 'LinkedIn Insight Pixel','answer' => '<p>The LinkedIn Insight Tag is a piece of lightweight JavaScript code that you can add to your website to enable in-depth campaign reporting and unlock valuable insights about your website visitors. You can use the LinkedIn Insight Tag to track conversions, retarget website visitors, and unlock additional insights about members interacting with your ads.!</p><p><code>e.g. 123456</code></p><p><a href="https://www.linkedin.com/help/linkedin/answer/65521" target="_blank">Learn more</a></p>','pricing' => '0'],

            ['slug' => 'twitter-pixel','category' => 'pixels','question' => 'Twitter Pixel','answer' => '<p>Conversion tracking for websites enables you to measure your return on investment by tracking the actions users take after viewing or engaging with your ads on Twitter.</p><p><code>e.g. 123456789</code></p><p><a href="https://business.twitter.com/en/help/campaign-measurement-and-analytics/conversion-tracking-for-websites.html" target="_blank">Learn more</a></p>','pricing' => '0'],

            ['slug' => 'adroll-pixel','category' => 'pixels','question' => 'AdRoll Pixel','answer' => '<p>The AdRoll Pixel is uniquely generated when you create an AdRoll account. The AdRoll ID has two components: the Advertiser ID or adroll_adv_id (X) and Pixel ID or adroll_pix_id (Y) for the AdRoll Pixel. To use the AdRoll Pixel, merge the two components together, separating them by a slash (/).</p><p><code>e.g. adroll_adv_id/adroll_pix_id</code></p><p><a href="https://help.adroll.com/hc/en-us/articles/211846018" target="_blank">Learn more</a></p>','pricing' => '0','created_at' => '2021-11-04 10:46:59'],

            ['slug' => 'quora-pixel','category' => 'pixels','question' => 'Quora Pixel Pixel','answer' => '<p>The Quora Pixel is a tool that is placed in your website code to track traffic and conversions. When someone clicks on your ad and lands on your website, the Quora Pixel allows you to identify how many people are visiting your website and what actions they are taking.</p><p><code>e.g. 1a79a4d60de6718e8e5b326e338ae533</code></p><p><a href="https://quoraadsupport.zendesk.com/hc/en-us/articles/115010466208-How-do-I-install-the-Quora-pixel-" target="_blank">Learn more</a></p>','pricing' => '0'],

            ['slug' => 'can-i-upgrade-my-account-at-any-time','category' => 'subscription','question' => ' Can I upgrade my account at any time?','answer' => '<p>Yes! You can start with our free package and upgrade anytime to enjoy premium features.</p>','pricing' => '1'],

            ['slug' => 'how-will-i-be-charged','category' => 'subscription','question' => 'How will I be charged?','answer' => '<p>You will be charged at the beginning of each period automatically until canceled.</p>','pricing' => '1'],

            ['slug' => 'what-happens-when-i-delete-my-account','category' => 'subscription','question' => 'What happens when I delete my account?','answer' => '<p>Once your account has been deleted, your subscription will be canceled and we will wipe all of your data from our servers including but not limited to your links, traffic data, pixels and all other associated data.</p>','pricing' => '1'],

            ['slug' => 'how-do-refunds-work','category' => 'subscription','question' => ' How do refunds work?','answer' => '<p>Upon request, we will issue a refund at the moment of the request for all <strong>upcoming</strong periods. If you are on a monthly plan, we will stop charging you at the end of your current billing period. If you are on a yearly plan, we will refund amounts for the remaining months.</p>','pricing' => '1']
        ];

        $allConfig = config();

        if(!isset($allConfig->faqcategories)){
            $query = DB::settings()->create();
            $query->config = 'faqcategories';
            $query->var = $categories;
            $query->save();
        } else{
            $query = DB::settings()->where('config', 'faqcategories')->first();

            $faqcategories = json_decode($query->var);

            foreach(json_decode($categories, true) as $name => $data){
                if(isset($categories->{$name})) continue;

                $faqcategories->{$name} = ['title' => $data['title'], 'description' => $data['description']];
            }

            $query->var = json_encode($faqcategories);
            $query->save();
        }

        \Models\Settings::updateSettings();

        foreach($faqs as $request){
            if(DB::faqs()->where('slug', $request['slug'])->first()) continue;
            $faq = DB::faqs()->create();
            $faq->question = $request['question'];
            $faq->slug = $request['slug'];
            $faq->answer = $request['answer'];
            $faq->category = $request['category'];
            $faq->pricing = $request['pricing'];
            $faq->created_at = Helper::dtime();
            $faq->save();
        }
    }
    /**
     * Migrating Teams
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.8
     * @return void
     */
    public function migrateTeams(){

        if(DB::columnExists('user', 'teamid') === false) return true;

        foreach(DB::user()->whereNotNull('teamid')->find() as $user){
            $member = DB::members()->create();
            $member->userid = $user->id;
            $member->teamid = $user->teamid;
            $member->permission = $user->teampermission;
            $member->token = md5($user->id.$user->email.time().Helper::rand(12));
            $member->status = $user->active;
            $member->created_at = Helper::dtime();
            $member->save();

            $user->teamid = null;
            $user->teampermission = null;
            $user->save();
        }
    }
    /**
     * Migrate Pixels
     *
     * @author GemPixel <https://gempixel.com>
     * @version 6.0
     * @return void
     */
    public function migratepixels(){

        foreach(DB::user()->find() as $user){

            $pixels = null;
            if($user->fbpixel && $pixels = json_decode($user->fbpixel)){

                foreach($pixels as $id => $pixel){

                    if(DB::pixels()->where('userid', $user->id)->where('type', 'fbpixel')->where('tag', $pixel->tag)->first()) continue;

                    $pixel = DB::pixels()->create();
                    $pixel->userid =  $user->id;
                    $pixel->type = 'fbpixel';
                    $pixel->name = clean($pixel->name);
                    $pixel->tag = clean($pixel->tag);
                    $pixel->created_at = Helper::dtime('now');
                    $pixel->save();

                    DB::url()->where('userid', $user->id)->where('pixels', 'fbpixel-'.$id.'')->update(['pixels' => 'fbpixel-'.$pixel->id]);
                }
            }

            $pixels = null;
            if($user->adwordspixel && $pixels = json_decode($user->adwordspixel)){
                foreach($pixels as $id => $pixel){

                    if(DB::pixels()->where('userid', $user->id)->where('type', 'adwordspixel')->where('tag', $pixel->tag)->first()) continue;

                    $pixel = DB::pixels()->create();
                    $pixel->userid =  $user->id;
                    $pixel->type = 'adwordspixel';
                    $pixel->name = clean($pixel->name);
                    $pixel->tag = clean($pixel->tag);
                    $pixel->created_at = Helper::dtime('now');
                    $pixel->save();

                    DB::url()->where('userid', $user->id)->where('pixels', 'adwordspixel-'.$id.'')->update(['pixels' => 'adwordspixel-'.$pixel->id]);
                }
            }

            $pixels = null;
            if($user->linkedinpixel && $pixels = json_decode($user->linkedinpixel)){
                foreach($pixels as $id => $pixel){

                    if(DB::pixels()->where('userid', $user->id)->where('type', 'linkedinpixel')->where('tag', $pixel->tag)->first()) continue;

                    $pixel = DB::pixels()->create();
                    $pixel->userid =  $user->id;
                    $pixel->type = 'linkedinpixel';
                    $pixel->name = clean($pixel->name);
                    $pixel->tag = clean($pixel->tag);
                    $pixel->created_at = Helper::dtime('now');
                    $pixel->save();

                    DB::url()->where('userid', $user->id)->where('pixels', 'linkedinpixel-'.$id.'')->update(['pixels' => 'linkedinpixel-'.$pixel->id]);
                }
            }
            $pixels = null;
            if($user->twitterpixel && $pixels = json_decode($user->twitterpixel)){
                foreach($pixels as $id => $pixel){

                    if(DB::pixels()->where('userid', $user->id)->where('type', 'twitterpixel')->where('tag', $pixel->tag)->first()) continue;

                    $pixel = DB::pixels()->create();
                    $pixel->userid =  $user->id;
                    $pixel->type = 'twitterpixel';
                    $pixel->name = clean($pixel->name);
                    $pixel->tag = clean($pixel->tag);
                    $pixel->created_at = Helper::dtime('now');
                    $pixel->save();

                    DB::url()->where('userid', $user->id)->where('pixels', 'twitterpixel-'.$id.'')->update(['pixels' => 'twitterpixel-'.$pixel->id]);
                }
            }
            $pixels = null;
            if($user->adrollpixel && $pixels = json_decode($user->adrollpixel)){
                foreach($pixels as $id => $pixel){

                    if(DB::pixels()->where('userid', $user->id)->where('type', 'adrollpixel')->where('tag', $pixel->tag)->first()) continue;

                    $pixel = DB::pixels()->create();
                    $pixel->userid =  $user->id;
                    $pixel->type = 'adrollpixel';
                    $pixel->name = clean($pixel->name);
                    $pixel->tag = clean($pixel->tag);
                    $pixel->created_at = Helper::dtime('now');
                    $pixel->save();

                    DB::url()->where('userid', $user->id)->where('pixels', 'adrollpixel-'.$id.'')->update(['pixels' => 'adrollpixel-'.$pixel->id]);
                }
            }
            $pixels = null;
            if($user->gtmpixel && $pixels = json_decode($user->gtmpixel)){
                foreach($pixels as $id => $pixel){

                    if(DB::pixels()->where('userid', $user->id)->where('type', 'gtmpixel')->where('tag', $pixel->tag)->first()) continue;

                    $pixel = DB::pixels()->create();
                    $pixel->userid =  $user->id;
                    $pixel->type = 'gtmpixel';
                    $pixel->name = clean($pixel->name);
                    $pixel->tag = clean($pixel->tag);
                    $pixel->created_at = Helper::dtime('now');
                    $pixel->save();

                    DB::url()->where('userid', $user->id)->where('pixels', 'gtmpixel-'.$id.'')->update(['pixels' => 'gtmpixel-'.$pixel->id]);
                }
            }
        }

    }
        /**
     * CSS
     *
     * @author GemPixel <https://gempixel.com>
     * @version 7.4
     * @return void
     */
    private function css(){
        $css = ':root {
            --bg: #f2f4f7;
            --ct: #ffffff;
            --color: #333a46;
            --primary: #5b59d8;
            --input: #fff;
        }
        * {
            box-sizing: border-box;
        }
        body {
            background-color: var(--bg);
            font-family: Helvetica, Arial;
            line-height: 25px;
            font-size: 13px;
            color: var(--color);
        }
        .container{
            max-width: 860px;
            width: 100%;
            margin: 0 auto;
            padding: 8rem 0 20px;
        }
        a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }
        a:hover {
            opacity: 0.9;
            text-decoration: none;
        }
        .card {
            background: var(--ct);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 10px;
            display: block;
            overflow: hidden;
            margin: 15px 0;
            padding: 18px;
        }
        .card h1 {
            font-size: 20px;
            display: block;
            border-bottom: 1px solid #e6eaef;
            margin: 0 !important;
            padding: 20px 10px;
        }
        .card h2 {
            color: var(--color);
            font-size: 18px;
        }
        .card h3 {
            border-bottom: 1px solid #e6eaef;
            border-radius: 3px 0 0 0;
            text-align: center;
            margin: 0;
            padding: 20px 0;
        }
        .form {
            display: block;
            border: 1px solid #e6eaef;
            border-radius: 5px;
        }
        .form label {
            font-size: 15px;
            font-weight: 700;
            display: block;
        }
        .form label a {
            float: right;
            color: var(--primary);
            font: bold 12px Helvetica, Arial;
            padding-top: 5px;
        }
        .form .input {
            background: var(--input);
            display: block;
            width: 100%;
            padding: 10px;
            border: 2px #e6eaef solid;
            font: bold 15px Helvetica, Arial;
            color: #000;
            border-radius: 3px;
            margin: 10px 0;
            padding: 15px;
        }
        .form .input:focus {
            border: 2px var(--primary) solid;
            outline: none;
            color: #000e6eaef;
        }
        .form .group{
            padding: 10px;
        }
        .button {
            background-color: var(--primary);
            font-weight: 700;
            display: block;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            color: #fff;
            font: 15px Helvetica, Arial bold;
            cursor: pointer;
            margin: 30px auto;
            padding: 10px 30px;
            border: 0;
            font-weight: 700;
            float: right;
        }

        .button:active,
        .button:hover {
            opacity: 0.9;
            color: #fff;
        }
        .button span {
            vertical-align: top;
        }
        .button:hover svg {
            transform: translateX(10px);
        }

        .button svg {
            transition: 0.5s linear transform;
        }
        .content {
            color: var(--color);
            display: block;
            border: 1px solid #e6eaef;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        li {
            color: var(--color);
        }
        li.current {
            color: #000;
            font-weight: 700;
        }
        li span {
            float: right;
            margin-right: 10px;
            font-size: 11px;
            font-weight: 700;
            color: #00b300;
        }
        .content > p {
            color: var(--color);
            font-weight: 700;
        }
        span.ok {
            float: right;
            border-radius: 3px;
            background-color: #59d8c5;
            font-weight: 700;
            background-image: -moz-linear-gradient(45deg, #59d8c5 0%, #68b835 100%);
            background-image: -webkit-linear-gradient(45deg, #59d8c5 0%, #68b835 100%);
            background-image: -ms-linear-gradient(45deg, #59d8c5 0%, #68b835 100%);
            color: #fff;
            padding: 2px 10px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        span.fail {
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            float: right;
            border-radius: 3px;
            background-color: #ff3146;
            font-weight: 700;
            background-image: -moz-linear-gradient(45deg, #f04c74 0%, #ff3146 100%);
            background-image: -webkit-linear-gradient(45deg, #f04c74 0%, #ff3146 100%);
            background-image: -ms-linear-gradient(45deg, #f04c74 0%, #ff3146 100%);
            color: #fff;
            padding: 2px 10px;
        }
        span.warning {
            float: right;
            border-radius: 3px;
            background: #fb923c;
            color: #fff;
            padding: 2px 10px;
        }
        .bg-success,
        .alert-success {
            background: #68b835;
            color: #fff;
            font: bold 15px Helvetica, Arial;
            border: 1px solid #68b835;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        .bg-danger,
        alert-danger {
            background-color: #ff3146;
            background-image: -moz-linear-gradient(45deg, #f04c74 0%, #ff3146 100%);
            background-image: -webkit-linear-gradient(45deg, #f04c74 0%, #ff3146 100%);
            background-image: -ms-linear-gradient(45deg, #f04c74 0%, #ff3146 100%);
            color: #fff;
            font: bold 15px Helvetica, Arial;
            margin: 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        span.hide,
        p.hide {
            display: none;
        }
        .info {
            display: block;
        }
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
            font-size: 0.9em;
        }
        ul li {
            overflow: hidden;
            margin-bottom: 10px;
        }
        ul li span {
            font-size: 0.8em;
        }
        ul li strong {
            opacity: 0.8;
        }
        .progress {
            counter-reset: step;
        }
        .progress li {
            list-style: none;
            display: inline-block;
            width: 49.25%;
            position: relative;
            text-align: center;
            overflow: visible;
        }
        .progress li:before {
            content: counter(step);
            counter-increment: step;
            width: 30px;
            height: 30px;
            line-height : 30px;
            border: 2px solid #ddd;
            border-radius: 100%;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            background-color: #fff;
        }
        .progress li:after {
            content: "";
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: #ddd;
            top: 15px;
            left: -50%;
            z-index : -1;
        }
        .progress li:first-child:after {
            content: none;
        }
        .progress li.current {
            color: var(--primary);7
        }
        .progress li.current:before {
            border-color: var(--primary);
        }
        .progress li.current + li:after {
            background-color: var(--primary);
        }
        .progress li.current.completed:before {
            background: var(--primary);
            color: #fff;
            content: url("data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2230%22%20height%3D%2230%22%20fill%3D%22%23fff%22%20%20viewBox%3D%220%200%2016%2016%22%3E%0A%20%20%3Cpath%20d%3D%22M10.97%204.97a.75.75%200%200%201%201.07%201.05l-3.99%204.99a.75.75%200%200%201-1.08.02L4.324%208.384a.75.75%200%201%201%201.06-1.06l2.094%202.093%203.473-4.425z%22%2F%3E%0A%3C%2Fsvg%3E");
        }
        .float-right{
            float:right;
        }
        .footer{
            opacity: 0.8
        }
        .footer .float-right a{
            margin-left: 8px;
        }';

        $css = preg_replace("/\s{2,}/", " ", $css);
        $css = str_replace("\n", "", $css);
        $css = str_replace(', ', ",", $css);

        return $css;
    }
}
