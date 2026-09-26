	<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
						<title><?php echo $companyName;?></title>
						<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
					</head>
					<body style="margin:0; padding:10px 0 0 0;" bgcolor="#F8F8F8">
						<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
							<tr>
								<td align="center">
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
										   style="border-collapse: separate;box-shadow: 1px 0 1px 1px #B8B8B8;"
										   background="<?php echo $companyWeb;?>/assets/images/banner6.jpg">
										<tr>
											<td align="center" style="padding: 5px 5px 5px 5px;">
												<a href="<?php echo $companyWeb;?>" target="_blank">
													<img src="<?php echo $companyWeb;?>/assets/images/logo-header.png" alt="Logo" style="width:186px;border:0;"/>
												</a>
											</td>
										</tr>
										<tr>
											<td bgcolor="#e9f8fd" style="padding: 40px 30px 40px 30px;">
												<table border="0" cellpadding="0" cellspacing="0" width="100%%">
													<tr>
														<td align="center" style="font-family: Poppins, sans-serif;font-size:36px;color:#2a2b33;font-weight:700;">
															<!-- Initial relevant banner image goes here under src-->
															 <?php echo $subject;?>
														</td>
													</tr>							
												</table>
											</td>
										</tr>
										<tr>
											<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
												<table border="0" cellpadding="0" cellspacing="0" width="100%%">                            
													<tr>
														<td style="padding: 10px 0 10px 0; font-family: Avenir, sans-serif; font-size: 16px;">

		                                                   Dear <?php echo $userName;?>,<br><br>  
		                                                       Application Details<br><br>
		                                                       Name:<?php echo $user;?><br> 
		                                                       Email:<?php echo $email;?><br>  
		                                                       Phone:<?php echo $phone;?><br>  
		                                                      
		                                                        Resume:<a href="<?php echo $companyWeb;?>/Resume/<?php echo $id;?>/<?php echo str_replace(' ','_',$resume);?>">view</a><br><br> 
		                                                      
		                                                     
		                                                     <?php echo $showMessage;?>

		                                                      
														</td>
													</tr>
													<tr>
														<td>
															<?php echo $signature;?>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td bgcolor="#E8E8E8">
												<table border="0" cellpadding="0" cellspacing="0" width="100%%" style="padding: 20px 10px 10px 10px;">
													<tr>
														<td width="260" valign="top" style="padding: 0 0 15px 0;">
															<table border="0" cellpadding="0" cellspacing="0" width="100%%">
																<tr>
																	<td align="center">
																		<a href="tel:<?php echo $companyMobile;?>" target="_blank">
																			<img src="<?php echo $companyWeb;?>/assets/images/mail/employee.png" alt="Call us"
																				 style="display: block;"/>
																		</a>
																	</td>
																</tr>
																<tr>
																	<td align="center"
																		style="font-family: Avenir, sans-serif; color:#707070;font-size: 13px;padding: 10px 0 0 0;">
																		GIVE US A CALL
																	</td>
																</tr>
															</table>
														</td>
														<td style="font-size: 0; line-height: 0;" width="20">
															&nbsp;
														</td>
														<td width="260" valign="top">
															<table border="0" cellpadding="0" cellspacing="0" width="100%%" >
																<tr>
																	<td align="center">
																		<a href="mailto:<?php echo $companyEmail;?>">
																			<img src="<?php echo $companyWeb;?>/assets/images/mail/letter.png" alt="Email us"
																				 style="display: block;"/>
																		</a>
																	</td>
																</tr>
																<tr>
																	<td align="center"
																		style="font-family: Avenir, sans-serif; color:#707070;font-size: 13px;padding: 10px 0 0 0;">
																		EMAIL US
																	</td>
																</tr>
															</table>
														</td>
														<td style="font-size: 0; line-height: 0;" width="20">
															&nbsp;
														</td>
														<td width="260" valign="top">
															<table border="0" cellpadding="0" cellspacing="0" width="100%%">
																<tr>
																	<td align="center">
																		<a href="<?php echo $companyWeb;?>/job" target="_blank">
																			<img src="<?php echo $companyWeb;?>/assets/images/mail/store.png" alt="FAQ Page"
																				 style="display: block;"/>
																		</a>
																	</td>
																</tr>
																<tr>
																	<td align="center"
																		style="font-family: Avenir, sans-serif; color:#707070;font-size: 13px;padding: 10px 0 0 0;">
																		BROWSE LISTINGS
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										
									</table>
								</td>
							</tr>
						</table>
					</body>
				</html>