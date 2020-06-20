<?php

class Profile_Layout {

	private $id;
    private $change_picture;
    public $disabled;
    private $user_data; 
    private $save_btn;


    public function new_dln(){
        $param_id = "";
        if(isset($_GET['id'])){
            $param_id = $_GET['id'];
        }else{
            $param_id = "";
        }
        if( ! is_user_logged_in()){
            return "disabled";
        }elseif(is_user_logged_in() && !isset($_GET['id'])){
            return "";
        }elseif(!is_user_logged_in() && isset($_GET['id'])){
            return "disabled";
        }elseif(!is_user_logged_in() && !isset($_GET['id'])){
            echo '<script>>window.location.href = '.site_url().'</script>';
        }elseif(get_current_user_id()  !== $_GET['id']){
			return "disabled";
		}
    }

	private function left_sidebar() {
		$html = '   ';
		echo $html;
	}

	private function profile_main() {
		if ( ! isset( $_GET['id'] ) && ! is_user_logged_in() ) {
			echo '<script>window.location.href = "' . site_url() . '"</script>';
		} elseif ( isset( $_GET['id'] ) ) {
			$this->id = $_GET['id'];
		} elseif(is_user_logged_in() && !isset($_GET['id'])) {
			$this->id = get_current_user_id();
		}
		$user_data    = get_user_by( 'ID', $this->id );
		$user_picture = get_user_meta( $this->id, 'profile_picture', true );

		// change Picture markup
		if ( ! isset( $_GET['id'] ) && ! is_user_logged_in() ) {
			$this->change_picture = '';
		} elseif ( isset($_GET['id']) && get_current_user_id() == $_GET['id'] || (is_user_logged_in() && !isset($_GET['id'])) ) {
			$this->change_picture = '<button class="btn btn-primary" id="change-photo" type="button">
        <i class="fa fa-fw fa-camera"></i>
        <span>Change Photo</span>
        </button>';
        $this->save_btn = '<div class="row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-primary" id="save-changes" type="button" name="save-changes">Save Changes</button>
        </div>
    </div>';

		}elseif(!isset($_GET['id']) && is_user_logged_in()){
            $this->id = get_current_user_id();
        }
        $html = '       <div class="col">
        <div class="message-success"></div>
      <div class="row">
     
          <div class="col mb-3">
              <div class="card">
                  <div class="card-body">
                      <div class="e-profile">
                          <div class="row">
                              <div class="col-12 col-sm-auto mb-3">
                                  <div class="mx-auto" style="width: 140px;">
                                      <div class="d-flex justify-content-center align-items-center rounded profile-form-img"
                                          style="height: 140px; background-color: rgb(233, 236, 239);
                                           background-image: url(' . $user_picture . '); background-position:center; background-size:cover;">
                                      </div>
                                      <input type="hidden" name="profile_picture_save" id="save_form_picture" value="">
                                  </div>
                                  ' . $this->change_picture . '
                              </div>
                              <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                                      <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">' . $user_data->user_nicename . '</h4>
                                      <div class="mt-2">
                                          
                                      </div>
                                  </div>
                                  <div class="text-center text-sm-right">
                                      <span class="badge badge-secondary">' . $user_data->user_login . '</span>
                                      <div class="text-muted"><small>Joined
                                              ' . $user_data->user_registered . '</small></div>
                                  </div>
                             </div>
                          </div>
                          <div id="tab-1" class="tab-content pt-3">
                              <div class="tab-pane active">
                                  <form class="form" action="javascript:void(0)" method="post">
                                      <div class="row">
                                          <div class="col">
                                              <div class="row">
                                                  <div class="col">
                                                      <div class="form-group">
                                                          <label>Full Name</label>
                                                          <input id="display-name" class="form-control" type="text" name="name"
                                                              placeholder="Enter Name Here"
                                                              value="' . $user_data->display_name . '" '.$this->new_dln() .' >
                                                      </div> 
                                                  </div>
                                                  <div class="col">
                                                      <div class="form-group">
                                                          <label>Username</label>
                                                          <input class="form-control" type="text" name="username"
                                                              placeholder="' . $user_data->user_login . '" disabled>
                                                              <span style="font-size:12px; color:red">Username cannot be changed!</span>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col">
                                                      <div class="form-group">
                                                          <label>Email</label>
                                                          <input id="email" class="form-control" type="text"
                                                              placeholder="Enter Email Address Here"
                                                              value="' . $user_data->user_email . '" '.$this->new_dln() .'>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col mb-3">
                                                      <div class="form-group">
                                                          <label>About</label>
                                                          <textarea id="description" class="form-control"  '.$this->disabled.' rows="5"
                                                              placeholder="My Bio" '.$this->new_dln() .'>' . get_user_meta( $this->id, 'description', true ) . '</textarea>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col mb-3">
                                                      <div class="form-group">
                                                          <label>IBAN</label>
                                                          <input id="iban" class="form-control" type="text"
                                                              placeholder="Enter your IBAN # Here"
                                                              value="' . get_user_meta($this->id,"IBAN",true) . '" '.$this->new_dln() .'>
                                                      </div>
                                                  </div>
                                                  <div class="col mb-3">
                                                      <div class="form-group">
                                                          <label>BitCoin Wallet #</label>
                                                          <input id="bitcoin" class="form-control" type="text"
                                                              placeholder="Enter your Bitocin Wallet # Here"
                                                              value="' . get_user_meta($this->id,"Bitcoin",true). '" '.$this->new_dln() .'>
                                                      </div>
                                                  </div>
                                                  <div class="col mb-3">
                                                      <div class="form-group">
                                                          <label>Revolut</label>
                                                          <input id="revolut" class="form-control" type="text"
                                                              placeholder="Enter your Revolut # Here"
                                                              value="' . get_user_meta($this->id,"Revolut",true) . '" '.$this->new_dln() .'>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="row">
                                              <div class="col">
                                                  <div class="form-group">
                                                      <label>Address</label>
                                                      <input id="address" class="form-control" type="text"
                                                          placeholder="Enter Address Here"
                                                          value="' . get_user_meta($this->id,"Address",true). '" '.$this->new_dln() .'>
                                                  </div>
                                              </div>
                                          </div>
                                          </div>
                                      </div>
                                     
                                      '.$this->save_btn.'
                                  </form>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>';
		  echo $html;
	}

	private function right_sidebar() {
		$user_get_id = '';
		if ( ! empty( $_GET['id'] ) ) {
			$user_get_id = $_GET['id'];
		}else{
            $user_get_id = get_current_user_id();
        }
        $logged_in_user = get_current_user_id();
        $user_data    = get_user_by( 'ID', $this->id );
		if ( $user_get_id == $logged_in_user || !isset($_GET['id']) && is_user_logged_in()  ) {
			echo '<div class="col-12 col-md-3 mb-3">
      <div class="card mb-3">
          <div class="card-body">
              <div class="px-xl-3">
                  <form method="post">
                      <input type="submit" name="logout" class="btn btn-block btn-secondary"
                          value="Logout">
                      <i class="fa fa-sign-out"></i>
                      </input>
                  </form>
              </div>
          </div>
      </div>
      <div class="card">
          <div class="card-body">
              <h6 class="card-title font-weight-bold">Support</h6>
              <p class="card-text">Get fast, free help from our friendly assistants.</p>
              <a href="mailto:'.$user_data->user_email.'"class="btn btn-primary">Contact Us</a>
          </div>
      </div>
      </div>';
		}else{
            echo '<div class="col-12 col-md-3 mb-3">
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="card-title font-weight-bold">Support</h6>
                <p class="card-text">Get fast, free help from our friendly assistants.</p>
                <a href="mailto:'.$user_data->user_email.'"class="btn btn-primary">Contact Us</a>
            </div>
        </div>
        </div>';
        }
	}

	public function dynamic_layout() {
		echo '<div class="container">
      <div class="row flex-lg-nowrap">
     
      ';
		$this->left_sidebar();
		$this->profile_main();
		$this->right_sidebar();

		echo '</div>

      </div>
        </div>
      </div>';
	}
}
new Profile_Layout();