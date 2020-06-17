<?php
namespace ElementorCustom\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Donor_Login extends Widget_Base {

	public function gum($field){
		$store = get_user_meta(get_current_user_id(),$field,true);
		if(!$store == ""){
			echo "value=" . $store;
		}

	}
	public function gumt($field){
		$store = get_user_meta(get_current_user_id(),$field,true);
		if(!$store == ""){
			echo $store;
		}

	}
	public function get_name() {
		return 'login_module';
	}
	public function get_title() {
		return __( 'Donor Login Form', 'elementor-custom' );
	}

	// Widget Icon
	public function get_icon() {
		return 'eicon-layout-settings';
	}

	public function get_categories() {
		return array( 'Custom' );
	}

	public function get_script_depends() {
		return array( 'elementor-custom' );
	}

	public function get_style_depends() {
		return array( 'elementor-custom-css' );
	}

	// Widget Controls
	protected function _register_controls() {

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

<style>
.global-container{
	height:100%;
	display: flex;
	align-items: center;
	justify-content: center;
	background-color: #f5f5f5;
}

form{
	padding-top: 10px;
	font-size: 14px;
	margin-top: 30px;
}

.card-title{ font-weight:300; }

.btn{
	font-size: 14px;
	margin-top:20px;
}


.login-form{ 
	width:330px;
	margin:20px;
}

.sign-up{
	text-align:center;
	padding:20px 0 0;
}

.alert{
	margin-bottom:-30px;
	font-size: 13px;
	margin-top:20px;
}
</style>
<div class="global-container">
    
	<div class="card login-form">
	<div class="card-body">
    <div class="error-message"></div>
    <div class="success-message"></div>
		<h3 class="card-title text-center">Donor Login</h3>
		<div class="card-text">
			<!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
			<form action="javascript:void(0)">
				<!-- to error: add class "has-danger" -->
				<div class="form-group">
					<label for="exampleInputEmail1">Username</label>
					<input type="username" class="form-control form-control-sm" id="username" aria-describedby="username">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<a href="<?php echo site_url('wp-login.php?action=lostpassword') ?>" style="float:right;font-size:12px;">Forgot password?</a>
					<input type="password" class="form-control form-control-sm" id="password">
				</div>
				<button type="button" class="btn btn-primary btn-block" id="login-button">Sign in</button>
				
				<div class="sign-up">
					Don't have an account? <a href="#">Create One</a>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

<?php
	}
}