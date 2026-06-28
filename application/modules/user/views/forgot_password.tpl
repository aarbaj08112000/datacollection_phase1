<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta charset="utf-8" />
      <base href="<%$base_url%>" />
      <title><%$config['company_name']%></title>
      <!-- Favicon -->
      <link rel="icon" type="image/x-icon" href="<%base_url()%><%$config['company_fav_icon']%>" />
      <!-- Fonts -->
      <link rel="shortcut icon" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <meta http-equiv="cache-control" content="no-cache" />
      <meta http-equiv="pragma" content="no-cache" />
      <link rel="stylesheet" href="<%$base_url%>public/css/gilroy-fonts.css" />
      <link rel="stylesheet" href="<%$base_url%>public/css/tabler_css/tabler_icons.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="<%$base_url%>public/css/login/login_page.css">
      <!-- toaster -->
       <link rel="stylesheet" href="public/css/toaster/custom_toaster.css" />
        <link rel="stylesheet" href="public/css/fontawesome/font_awesome.css">
     <!-- toaster -->
   </head>
   <body data-new-gr-c-s-check-loaded="14.1208.0" data-gr-ext-installed="">
     
      <div class="login-main-page custom-login-bg outer-div-box">
         <div class="errorbox-position" id="var_msg_cnt" style="display: none;">
            <div class="closebtn-errorbox" id="closebtn_errorbox">
               <a href="javascript://" onclick="Project.closeMessage();"><button class="close" type="button">×</button></a>
            </div>
            <div class="content-errorbox alert" id="err_msg_cnt"></div>
         </div>
         <div class="content-login" id="content_login">
            <div class="login_page">
               <style>
                  .top-bg {
                  display: none !important;
                  }
               </style>
               <div class="login_lt_panel">
                  <div class="d-flex h-100">
                     <div class="row justify-content-center align-self-center m-0 w-100">
                        <div class="loginContainer login-form">
                           <div class="loginbox-border">
                              <div>

                                 <div id="forgot_div" class="forgot-pwd-screen" >
                                    <div class="logo_login">
                                        <a href="<%$base_url%>" class="brand">
                                            <img alt="<%$config['company_name']%>" class="admin-logo-top" src="<%base_url()%><%$config['company_logo']%>" title="<%$config['company_name']%>">
                                        </a>
                                    </div>
                                    <%if $expired_link eq 'No' %>
	                                    <div class="login-headbg">
	                                        <h2>Reset Password
	                                            <span>Enter a new password to reset the password on your account.</span>
	                                        </h2>
	                                    </div>
	                                    <div width="28%" class="relative">
	                                        <form
	                                       id="formRestePassword" class="mb-3" action="javascript:void(0)" method="POST"
	                                       >
	                                       <input type="hidden" name="user_id" value="<%$user_id%>">
	                                       	  <label for="passwd">Password </label>
		                                       <div class="bmatter relative">
		                                          <a id="pwd_show_hide" class="login-pwd-icon" href="javascript://"><i class="ti ti-lock" data-status="show"></i></a>
		                                          <input
		                                             type="password"
		                                             title="Password"
		                                             name="password"
		                                            id="password"
		                                             size="25"
		                                             value=""
		                                             placeholder="Password"
		                                             />
		                                       </div>
		                                       <div class="clear"></div>
		                                       <div class="error-msg login-error-msg" id="passwordErr"></div>
	                                          <label for="passwd">Confirm Password</label>
		                                       <div class="bmatter relative">
		                                          <a id="pwd_show_hide" class="login-pwd-icon" href="javascript://"><i class="ti ti-lock" data-status="show"></i></a>
		                                          <input
		                                             type="password"
		                                             title="confirm_password"
		                                             name="confirm_password"
		                                             id="confirm_password"
		                                             size="25"
		                                             value=""
		                                             placeholder="Confirm Password"
		                                             />
		                                       </div>
		                                       <div class="clear"></div>
		                                       <div class="error-msg login-error-msg" id="confirm_passwordErr"></div>
	                                          <div class="forgot-pwd-btns normal-login-type">
	                                               <button type="submit" class="btn btn-info login-btn" id="loginBtn" >Reset Password<span class="icon16 icomoon-icon-enter white right"></span></button>
	                                              <span id="loader_img" class="forgot-loader-img right" style="display: none;"><i class="fa fa-refresh fa-spin-light fa-2x fa-fw"></i></span>
	                                          </div>
	                                        </form>
	                                        <div class="forgot-backlink">
	                                            Back to <span><a href="<%$base_url%>login" id="back_to_login"> login</a></span>
	                                                                                    </div>
	                                    </div>
	                                <%else%>
	                                	<div class="login-headbg ">
	                                        <h2>Link Expired
	                                            <span class="forgot-text">Your password reset link has expired, if you still wish to reset your forgotten password please go to the forgotten password page</span>
	                                        </h2>
	                                    </div>

	                                    <div class="forgot-pwd-btns normal-login-type">
	                                               <a href="<%$base_url%>login" class="btn btn-info login-btn" id="loginBtn" >Back To Forgot Password<span class="icon16 icomoon-icon-enter white right"></span></a>
	                                          </div>
	                                <%/if%>
                                </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="login_rt_panel">
                  <div class="lt_panel_img"><img src="<%$base_url%>public/assets/images/login_page_img2.png" /></div>
               </div>
            </div>
         </div>
      </div>
      <div class="login-bottom-page">
         <div>
            <div class="copyright" id="bot_copyright">
               <i class="las la-plus bottom-icons hide-icons" id="additional_btn"></i>
               Copyright 2024 © Audit System. All Rights Reserved
            </div>
         </div>
      </div>
   </body>
   <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="<%$base_url%>public/js/admin/plugin/jquery.min.js"></script>
  <script src="<%$base_url%>public/assets/vendor/libs/popper/popper.js"></script>
  <script src="<%$base_url%>public/assets/vendor/js/bootstrap.js"></script>
  <script src="<%$base_url%>public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
<link rel="stylesheet" href="<%$base_url%>public/plugin/select2/select2.min.css">
  <script  src="<%$base_url%>public/plugin/select2/select2.min.js"></script>
  <link rel="stylesheet" href="<%$base_url%>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
  var base_url = <%$base_url|@json_encode%>;
</script>
 <script src="public/js/toaster/custom_toaster.js"></script>
<script src="<%$base_url%>public/js/forgot_password.js"></script>
</html>