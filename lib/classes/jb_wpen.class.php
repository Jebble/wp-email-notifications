<?php

class JB_WPEN {

	protected $post_id;
	protected $email;
	protected $subject;
	protected $message;
	protected $headers = [];
	protected $attachments = [];
	protected $settings = [];

	/**
	 * Get and set post_id, post and settings.
	 * @param [int] $post_id [The post_id from the WordPress post.]
	 */
	public function __construct( $post_id ) {
		$this->post_id = $post_id;
		$this->email = get_post( $this->post_id );

		$this->settings['bgcolor'] = get_option( 'jb_wpen-bgcolor', '#f2f2f2' );
		$this->settings['container-bgcolor'] = get_option( 'jb_wpen-container-bgcolor', '#ffffff' );
		$this->settings['textcolor'] = get_option( 'jb_wpen-textcolor', '#424242' );
	}

	/**
	 * Set the email subject
	 */
	protected function set_subject() {
		$this->subject = get_post_meta( $this->post_id, 'jb_wpen_email_subject', true );
		return $this;
	}

	/**
	 * Set the email message
	 */
	protected function set_message() {

		$logo_id = get_post_meta( $this->post_id, 'jb_wpen_email_logo', true );
		$logo = wp_get_attachment_url( $logo_id );

		$this->message = $this->create_html( $this->email->post_content, $logo );
		return $this;
	}

	/**
	 * Set the email headers
	 */
	protected function set_headers() {
		$this->headers[] = 'MIME-Version: 1.0';
		$this->headers[] = 'Content-type: text/html; charset=iso-8859-1';

		$from_name = get_post_meta( $this->post_id, 'jb_wpen_email_from_name', true );
		$from_email = get_post_meta( $this->post_id, 'jb_wpen_email_from_email', true );
		if ( ! empty( $from_name ) && ! empty( $from_email ) ) {
			$this->headers[] = "From: {$from_name} <{$from_email}>";
		}

		return $this;
	}

	/**
	 * Set the email attachments
	 */
	protected function set_attachments() {
		$attachments_ids = get_post_meta( $this->post_id, 'jb_wpen_email_attachments', false );
		foreach ( $attachments_ids as $attachment_id ) {
			$this->attachments[] = get_attached_file( $attachment_id );
		}
		return $this;
	}

	/**
	 * Setup the email and send it using the wp_mail function;
	 * @param  [string|array] $to [Emailaddresses to send the email to]
	 * @return [boolean] wp_mail result
	 */
	public function send( $to ) {

		$this->set_subject()
		->set_message()
		->set_headers()
		->set_attachments();

		//wp_mail
		return wp_mail( $to, $this->subject, $this->message, $this->headers, $this->attachments );
	}

	/**
	 * Build the email HTML with chosen settings
	 * @param  [string] $content [HTML string containing the content for the e-mail.]
	 * @return [string] $html [HTML string containing the entire to send email]
	 *
	 * @credits to https://github.com/leemunroe for the e-mail template at https://github.com/leemunroe/responsive-html-email-template
	 */
	protected function create_html( $content, $logo ) {

		$content = wpautop( $content, true );
		$content =  apply_filters( 'the_content', $content );

		$html = '<!DOCTYPE html>
			<html>
				<head>
					<meta name="viewport" content="width=device-width">
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
					<title>' . $this->subject . '</title>
					<style type="text/css">
						/* -------------------------------------
						INLINED WITH https://putsmail.com/inliner
						------------------------------------- */
						/* -------------------------------------
						RESPONSIVE AND MOBILE FRIENDLY STYLES
						------------------------------------- */
						@media only screen and (max-width: 620px) {
						table[class=body] h1 {
						font-size: 28px !important;
						margin-bottom: 10px !important; }
						table[class=body] p,
						table[class=body] ul,
						table[class=body] ol,
						table[class=body] td,
						table[class=body] span,
						table[class=body] a {
						font-size: 16px !important; }
						table[class=body] .wrapper,
						table[class=body] .article {
						padding: 10px !important; }
						table[class=body] .content {
						padding: 0 !important; }
						table[class=body] .container {
						padding: 0 !important;
						width: 100% !important; }
						table[class=body] .main {
						border-left-width: 0 !important;
						border-radius: 0 !important;
						border-right-width: 0 !important; }
						table[class=body] .btn table {
						width: 100% !important; }
						table[class=body] .btn a {
						width: 100% !important; }
						table[class=body] .img-responsive {
						height: auto !important;
						max-width: 100% !important;
						width: auto !important; }}
						/* -------------------------------------
						PRESERVE THESE STYLES IN THE HEAD
						------------------------------------- */
						@media all {
						.ExternalClass {
						width: 100%; }
						p { margin-bottom: 15px; }
						.ExternalClass,
						.ExternalClass p,
						.ExternalClass span,
						.ExternalClass font,
						.ExternalClass td,
						.ExternalClass div {
						line-height: 100%; }
						.apple-link a {
						color: inherit !important;
						font-family: inherit !important;
						font-size: inherit !important;
						font-weight: inherit !important;
						line-height: inherit !important;
						text-decoration: none !important; }
						.btn-primary table td:hover {
						background-color: #34495e !important; }
						.btn-primary a:hover {
						background-color: #34495e !important;
						border-color: #34495e !important; } }
					</style>
				</head>
				<body class="" style="background-color:' . $this->settings['bgcolor'] . ';font-family:sans-serif;-webkit-font-smoothing:antialiased;font-size:14px;line-height:1.4;margin:0;padding:0;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;">
				<table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;background-color:' . $this->settings['bgcolor'] . ';width:100%;">
				<tr>
				<td style="font-family:sans-serif;font-size:14px;vertical-align:top;">&nbsp;</td>
				<td class="container" style="font-family:sans-serif;font-size:14px;vertical-align:top;display:block;max-width:580px;padding:10px;width:580px;Margin:0 auto !important;">
				<div class="content" style="box-sizing:border-box;display:block;Margin:0 auto;max-width:580px;padding:10px;">';
				if ( $logo ) :
					$html .= '
						<div style="width:100%;text-align:center;">
							<img src="' . $logo . '" style="max-width:100%;text-align:center;margin-bottom:30px;">
						</div>
					';
				endif;
				$html .= '
				<!-- START CENTERED WHITE CONTAINER -->
				<table class="main" style="border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;background:' . $this->settings['container-bgcolor'] . ';border-radius:3px;width:100%;">
				<!-- START MAIN CONTENT AREA -->
				<tr>
				<td class="wrapper" style="font-family:sans-serif;font-size:14px;vertical-align:top;box-sizing:border-box;padding:20px;">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;width:100%;">
				<tr>
				<td style="font-family:sans-serif;font-size:14px;vertical-align:top;">
					' . $content . '
				</td>
				</tr>
				</table>
				</td>
				</tr>
				<!-- END MAIN CONTENT AREA -->
				</table>
				<!-- START FOOTER -->
				<div class="footer" style="clear:both;padding-top:10px;text-align:center;width:100%;">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;width:100%;">
				<tr>
				<td class="content-block" style="font-family:sans-serif;font-size:14px;vertical-align:top;color:#999999;font-size:12px;text-align:center;">
				<span class="apple-link" style="color:#999999;font-size:12px;text-align:center;"></span>
				<br>
				</td>
				</tr>
				</table>
				</div>
				<!-- END FOOTER -->
				<!-- END CENTERED WHITE CONTAINER -->
				</div>
				</td>
				<td style="font-family:sans-serif;font-size:14px;vertical-align:top;">&nbsp;</td>
				</tr>
				</table>
				</body>
			</html>
		';

		return $html;
	}

}