<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jainam
 */

?>
 <footer>
        <div class="container">
            <div class="footer-inner">
                <div class="footer-row-one"><?php 
                    $footer_logo = get_field('footer_logo', 'option');
                    $footer_url = isset($footer_logo['url']) ? $footer_logo['url'] : '';
                    $footer_alt = isset($footer_logo['alt']) ? $footer_logo['alt'] : ''; 
                    if ($footer_url) {?>
                        <div class="logo footer-logo">
                            <a href="<?php echo site_url(); ?>">
                                <img src="<?php echo esc_url($footer_url); ?>" alt="<?php echo esc_url($footer_alt); ?>">
                            </a>
                        </div><?php
                    } 
                    $footer_address_info = get_field('footer_address_info', 'option');
                    if($footer_address_info){?>
                        <div class="logo footer-logo">
                            <p><?php echo $footer_address_info; ?></p>
                        </div>
                    <?php } ?>

                    <div class="footer-content">
                        <?php $follow_us_on = get_field('follow_us_on','option');
                                if ($follow_us_on) {
                                        echo '<h4>' . $follow_us_on . '</h4>';
                                } else {
                                        echo '<h4>FOLLOW US ON</h4>';
                                }
                                ?>
                        <ul class="footer-social-icon"><?php if (have_rows('add_follow_us', 'option')){
                                    while (have_rows('add_follow_us', 'option')): the_row();
                                    $follow_us_on_icon = get_sub_field('follow_us_on_icon');
                                    $follow_us_on_link = get_sub_field('follow_us_on_link'); ?>
                                        <li>
                                            <a href="<?php echo $follow_us_on_link['url']; ?>" target="<?php echo $follow_us_on_link['target']; ?>">
                                                <img src="<?php echo $follow_us_on_icon['url']; ?>" alt="<?php echo $follow_us_on_icon['alt']; ?>">
                                        </a>
                                        </li>
                                    <?php  endwhile;
                                } else { ?> 
                        <?php } ?>
                    </ul>
                    <div>
                        <ul><?php
                            $google_play_image = get_field('google_play_image','option');
                            $google_play_url = get_field('google_play_url','option');
                            $apple_pay_image = get_field('apple_pay_image','option');
                            $apple_pay_url = get_field('apple_pay_url','option');
                            if($google_play_image || $apple_pay_image != ''){ ?>
                                <li class="play-store-icon">
                                    <a href="<?php echo $google_play_url['url']; ?>" target="<?php echo $google_play_url['target']; ?>">
                                        <img src="<?php echo $google_play_image['url']; ?>" alt="<?php echo $google_play_image['alt']; ?>">
                                    </a>
                                    <a href="<?php echo $apple_pay_url['url']; ?>" target="<?php echo $google_play_url['target']; ?>">
                                        <img src="<?php echo $apple_pay_image['url']; ?>" alt="<?php echo $apple_pay_image['alt']; ?>">
                                    </a>
                                </li>
                            <?php } else{?>
                                    <li class="play-store-icon">
                                    <a href="javascript:void(0)">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/play-store.webp" alt="play-store">
                                    </a>
                                    <a href="javascript:void(0)">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/apple-store.webp" alt="apple-store">
                                    </a>
                                </li><?php
                            }?>
                        </ul>
                    </div>
                </div>

                	</div>
                	<div class="footer-row-two">
                    <div class="footer-content">
						  <?php $technology_heading = get_field('technology_heading','option');
								if ($technology_heading) {
										echo '<h4>' . $technology_heading . '</h4>';
								} else {
										echo '<h4>Company</h4>';
								}
								?>
                        <ul>
									<?php if (have_rows('technology_list', 'option')){
										while (have_rows('technology_list', 'option')): the_row();
											$add_technology = get_sub_field('add_technology'); ?>
											<li>
												<a href="<?php echo esc_url($add_technology['url']); ?>"><?php echo esc_html($add_technology['title']); ?></a>
											</li>
										<?php  endwhile;
        							} ?>
                        </ul>
                    </div>
                    <div class="footer-content">
						  <?php $partner_with_us_heading = get_field('partner_with_us_heading','option');
									if ($partner_with_us_heading) {
											echo '<h4>' . $partner_with_us_heading . '</h4>';
									} else {
											echo '<h4>Company</h4>';
									}
									?>
                        <ul><?php if (have_rows('partner_with_us_list', 'option')){
										while (have_rows('partner_with_us_list', 'option')): the_row();
											$add_partner_with_us = get_sub_field('add_partner_with_us'); ?>
											<li>
												<a href="<?php echo esc_url($add_partner_with_us['url']); ?>"><?php echo esc_html($add_partner_with_us['title']); ?></a>
											</li>
										<?php  endwhile;  
										
        							} else { ?> 
                            <li>
                                <a href="<?php echo get_site_url(); ?>/partner-with-us/">Authorized person (AP) </a>
                            </li>
                            <li>
                                <a href="<?php echo get_site_url(); ?>/refer-earn/">Referral Associate</a>
                            </li>
									 
                         <?php } ?>
                        </ul>
                    </div>	 
                   
                </div>
                <div class="footer-row-three">
                    <div class="footer-content">
							<?php $quick_link_label = get_field('quick_link_label','option');
									if ($quick_link_label) {
											echo '<h4>' . $quick_link_label . '</h4>';
									} else {
											echo '<h4>Company</h4>';
									}
									?>
                        <ul><?php if (have_rows('quick_link_lists', 'option')){
										while (have_rows('quick_link_lists', 'option')): the_row();
											$add_quick_links = get_sub_field('add_quick_links'); ?>
											<li>
												<a href="<?php echo esc_url($add_quick_links['url']); ?>"><?php echo esc_html($add_quick_links['title']); ?></a>
											</li>
										<?php  endwhile;
        							} ?>
                        </ul>
                    </div>
                    
                </div>
                <div class="footer-row-four">
                    <div class="footer-content">
						  <?php $corporate_action_heading = get_field('corporate_action_heading','option');
									if ($corporate_action_heading) {
											echo '<h4>' . $corporate_action_heading . '</h4>';
									}
									?>
                        <ul><?php if (have_rows('corporate_action_list', 'option')){
										while (have_rows('corporate_action_list', 'option')): the_row();
											$add_corporate_action = get_sub_field('add_corporate_action'); ?>
											<li>
												<a href="<?php echo esc_url($add_corporate_action['url']); ?>"><?php echo esc_html($add_corporate_action['title']); ?></a>
											</li>
										<?php  endwhile;
        							} ?>
                        </ul>
                    </div>
                </div>
                <div class="footer-row-five">
                    <div class="footer-content">
                          <?php $add_community_heading = get_field('add_community_heading','option');
                                    if ($add_community_heading) {
                                            echo '<h4>' . $add_community_heading . '</h4>';
                                    } else {
                                            echo '<h4>Partner with Us</h4>';
                                    }
                                    ?>
                        <ul><?php if (have_rows('add_community_list', 'option')){
                                        while (have_rows('add_community_list', 'option')): the_row();
                                            $add_community = get_sub_field('add_community'); ?>
                                            <li>
                                                <a href="<?php echo esc_url($add_community['url']); ?>"><?php echo esc_html($add_community['title']); ?></a>
                                            </li>
                                        <?php  endwhile;
                                    } ?>
                        </ul>
                    </div>
                    <div class="footer-content">
						  <?php $add_offerings_heading = get_field('add_offerings_heading','option');
									if ($add_offerings_heading) {
											echo '<h4>' . $add_offerings_heading . '</h4>';
									} 
									?>
                        <ul><?php if (have_rows('add_offerings_list', 'option')){
										while (have_rows('add_offerings_list', 'option')): the_row();
											$add_offerings = get_sub_field('add_offerings'); ?>
											<li>
												<a href="<?php echo esc_url($add_offerings['url']); ?>"><?php echo esc_html($add_offerings['title']); ?></a>
											</li>
										<?php  endwhile;
        							} ?>
                        </ul>
                    </div>
                </div>
                <div class="footer-row-six">
                <?php if (have_rows('add_company_list', 'option')): ?>
							<div class="footer-content">
								<?php $company_heading = get_field('company_heading','option');

								if ($company_heading) {
										echo '<h4>' . $company_heading . '</h4>';
								}
								?>
								<ul>
										<?php
										while (have_rows('add_company_list', 'option')): the_row();
											$company_list = get_sub_field('company_list'); ?>
											<li>
												<a href="<?php echo esc_url($company_list['url']); ?>"><?php echo esc_html($company_list['title']); ?></a>
											</li>
										<?php endwhile; ?>
								</ul>
							</div>
						<?php else: ?>
							<div class="footer-content">
								<h4>Company</h4>
								<ul>
										<li>
											<a href="javascript:void(0)">About</a>
										</li>
										<li>
											<a href="javascript:void(0)">Events</a>
										</li>
										<li>
											<a href="javascript:void(0)">Careers</a>
										</li>
									
								</ul>
							</div>
						<?php endif; ?>
                   
                </div>

                <div class="footer-row-seven">
				   <div class="footer-content">
				      <h4>PARTNER WITH US</h4>
				      <ul>
				         <li>
				            <a href="<?php echo get_site_url(); ?>/partner-with-us/">Authorized Partner</a>
				         </li>
				         <li>
				            <a href="<?php echo get_site_url(); ?>/refer-earn/">Referral Partner</a>
				         </li>
				      </ul>
				   </div>
				</div>
                
            </div>

            <div class="footer-according"> 
                <ul class="footer-according-ul">
                    <?php /** ?>
                    <li data-target="#footer-according-li-dropdown1" class="footer-according-li">
                      <?php
							 $market_screeners_label = get_field('market_screeners_label','option');
							 if($market_screeners_label){ ?>
						  		<a href="javascript:void(0)" class="footer-according-a"><?php echo $market_screeners_label; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                <path d="M1 5L5 1L9 5" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
								<?php } 
								else{?>
									<a href="javascript:void(0)" class="footer-according-a">Market Screeners
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                <path d="M1 5L5 1L9 5" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a><?php
								}?>
                    </li><?php 
						  $mutual_funds_label = get_field('mutual_funds_label','option');
							 if($mutual_funds_label){ ?>
                    <li data-target="#footer-according-li-dropdown2" class="footer-according-li">
                        <a href="javascript:void(0)" class="footer-according-a"><?php echo $mutual_funds_label; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                <path d="M1 5L5 1L9 5" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                        <?php } else{ ?>
									<li data-target="#footer-according-li-dropdown2" class="footer-according-li">
                        <a href="javascript:void(0)" class="footer-according-a">Mutual Funds
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                <path d="M1 5L5 1L9 5" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a><?php } ?>
                    </li>
                    <li data-target="#footer-according-li-dropdown3" class="footer-according-li">
                        <a href="javascript:void(0)" class="footer-according-a">Stocks
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                <path d="M1 5L5 1L9 5" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>

                    <li id="footer-according-li-dropdown1" class="footer-according-li-dropdown">
                        <div class="footer-according-dropdown">
                            <div class="footer-according-dropdown-inner footer-inner">
									 <?php if (have_rows('market_screeners_list', 'option')): ?>
											<?php while (have_rows('market_screeners_list', 'option')): the_row(); ?>
													<div class="footer-according-dropdown-content footer-content">
														<?php
														$market_screeners_sub_heading = get_sub_field('market_screeners_sub_heading');
														if ($market_screeners_sub_heading) {
															echo '<h4>' . esc_html($market_screeners_sub_heading) . '</h4>';
														}
														?>
														<ul>
															<?php if (have_rows('market_screeners_listing')): ?>
																	<?php while (have_rows('market_screeners_listing')): the_row(); 
																		$market_screeners_link = get_sub_field('market_screeners_link');
																	?>
																		<li>
																			<a href="<?php echo esc_url($market_screeners_link['url']); ?>"><?php echo esc_html($market_screeners_link['title']); ?></a>
																		</li>
																	<?php endwhile; ?>
															<?php endif; ?>
														</ul>
													</div>
											<?php endwhile; ?>
										<?php endif; ?>
                            </div>
                        </div>
                    </li>
                    <li id="footer-according-li-dropdown2" class="footer-according-li-dropdown">
                        <div class="footer-according-dropdown">
                            <div class="footer-according-dropdown-inner footer-inner">
                               
									 <?php if (have_rows('mutual_funds_list', 'option')): ?>
											<?php while (have_rows('mutual_funds_list', 'option')): the_row(); ?>
													<div class="footer-according-dropdown-content footer-content">
														<?php
														$mutual_funds_sub_heading = get_sub_field('mutual_funds_sub_heading');
														if ($mutual_funds_sub_heading) {
															echo '<h4>' . esc_html($mutual_funds_sub_heading) . '</h4>';
														}
														?>
														<ul>
															<?php if (have_rows('mutual_funds_listings')): ?>
																	<?php while (have_rows('mutual_funds_listings')): the_row(); 
																		$mutual_funds_link = get_sub_field('mutual_funds_link');
																	?>
																		<li>
																			<a href="<?php echo esc_url($mutual_funds_link['url']); ?>"><?php echo esc_html($mutual_funds_link['title']); ?></a>
																		</li>
																	<?php endwhile; ?>
															<?php endif; ?>
														</ul>
													</div>
											<?php endwhile; ?>
										<?php endif; ?>

                            </div>
                        </div>
                    </li>
                    <li id="footer-according-li-dropdown3" class="footer-according-li-dropdown">
                        <div class="footer-according-dropdown">
                            <div class="footer-according-dropdown-inner footer-inner">
                                <div class="footer-according-dropdown-content footer-content">
                                    <h4>Stocks:</h4>
                                    <ul>    
                                        <li>
                                            <a href="javascript:void(0)">A</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">B</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">C</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">D</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">E</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">F</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">G</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">H</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">I</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">J</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">K</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">L</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">M</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">N</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">O</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">P</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Q</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">R</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">S</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">T</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">U</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">V</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">W</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">X</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Y</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Z</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">All</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li class="footer-according-li">
                        <a href="javascript:void(0)" class="footer-according-a">Indices
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                <path d="M1 5L5 1L9 5" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="footer-according-li">
                        <a href="javascript:void(0)" class="footer-according-a">Tools
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                <path d="M1 5L5 1L9 5" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li> <?php */ ?>
                    <?php
                        $important_information_label = get_field('important_information_label','option');
                    ?>
                    <li data-target="#footer-according-li-dropdown6" class="footer-according-li" style="max-width: 100%;">
                        <a href="#" class="footer-according-a"><?php echo $important_information_label; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                <path d="M1 5L5 1L9 5" stroke="#344054" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li id="footer-according-li-dropdown6" class="footer-according-li-dropdown">
                        <div class="footer-according-dropdown">
                            <ul class="footer-according-dropdown-inner footer-inner">
                                     <?php if (have_rows('important_information_list', 'option')): ?>
                                            <?php while (have_rows('important_information_list', 'option')): the_row(); ?>
                                                    <li class="footer-according-dropdown-content footer-content">
                                                        <?php
                                                        $market_screeners_sub_heading = get_sub_field('important_information_sub_heading');
                                                        /*if ($market_screeners_sub_heading) {
                                                            echo '<h4>' . esc_html($important_information_listings) . '</h4>';
                                                        }*/
                                                        ?>
                                                        
                                                            <?php if (have_rows('important_information_listings')): ?>
                                                                    <?php while (have_rows('important_information_listings')): the_row(); 
                                                                        $market_screeners_link = get_sub_field('important_information_link');
                                                                    ?>
                                                                        
                                                                            <a href="<?php echo esc_url($market_screeners_link['url']); ?>"><?php echo esc_html($market_screeners_link['title']); ?></a>
                                                                        
                                                                    <?php endwhile; ?>
                                                            <?php endif; ?>
                                                       
                                                    </li>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>

            <div class="footer-bottom jainam-active">
                <div class="footer-bottom-title">
						<?php
						$footer_bottom_title = get_field('footer-bottom-title', 'option');

						if($footer_bottom_title){ echo $footer_bottom_title;} ?>
                </div>

                <div class="footer_bottom_address">
            		<?php

						// Check rows exists.
						if( have_rows('footer_bottom_slider', 'option') ):

						    // Loop through rows.
						    while( have_rows('footer_bottom_slider', 'option') ) : the_row();

						        // Load sub field value.
						       $title = get_sub_field('title');
						       $description = get_sub_field('description');
						       ?>
						       	<div class="slider_address_bottom">
									<p class="title_cin"><b><?php echo $title; ?></b></p>
									<p><?php echo $description; ?></p>
								</div>
						       <?php
						    // End loop.
						    endwhile; 

						// No value.
						else :
						    // Do something...
						endif;

						?> 
            		 
            	</div>

            	<?php $footer_bottom_des = get_field('footer-bottom-des', 'option'); ?>

                <div class="footer-bottom-des"><?php
					 if($footer_bottom_des){ echo $footer_bottom_des;} else{ ?>
                    <p>Customers having any query / feedback / clarification may write to customer.care@jainam.in</p>
                    <p>Customers having any grievances or complaints may write to grievance@jainam.in</p>
                    <p>Jainam Broking Limited involves in proprietary trading alongside its clientele business</p>
                    <p>Jainam Commodities Private Limited is involved in proprietary trading with MCX & NCDEX in addition to clientele business.</p>
                    <p>Investors do not need to issue cheque while subscribing to an IPO. Bank account number and an application form authorizing your bank to make payment in case of allotment fulfills the requirement. No worries for refund as the money remains in investor's account.</p>
                    <p>Procedure to file a complaint on SEBI SCORES: Register on SCORES portal. Mandatory details for filing complaints on SCORES: Name, PAN, Address, Mobile Number, E-mail ID. Benefits: Effective Communication, Speedy redressal of the grievances.</p>
                    <p>Prevent Unauthorized Transactions in your Demat account - Update your mobile number with your depository articipant. Receive alerts on your registered mobile for all the transactions in your account directly from CDSL on the same day. Issued in interest of investors.</p>
                    <p>KYC is one time exercise while dealing in securities market - once the KYC is done through a SEBI registered intermediary (Broker, DP, Mutual Fund etc.), Investor does not need to repeat the procedure when he/she approaches another intermediary.</p>
                    <p>Attention Investors (1) Stock Brokers can accept securities as margin from clients only by way of pledge in the depository system w.e.f. September 1, 2020. (2) Update your mobile number & Email ID with your stock broker / depository participant and receive OTP directly from depository on your email ID and/or mobile number to create pledge. (3) Pay 20% upfront margin of the transaction value to trade in cash market segment. (4) Investors may please refer to the Exchange's Frequently Asked Questions (FAQs) issued vide circular reference NSE/INSP/45191 dated July 31, 2020 and NSE/INSP/45534 dated August 31, 2020 and other guidelines issued from time to time in this regard. (5) Check your Securities / MF / Bonds in the consolidated account statement issued by NSDL/CDSL every month.</p><?php } ?>
                </div>
            </div>
        </div>
    </footer> 
    <div class="overlay"></div>
   <?php wp_footer(); ?>
</body>
</html>