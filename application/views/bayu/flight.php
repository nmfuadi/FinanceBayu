<?php echo $this->session->flashdata('message');?>
<div class="holiday-package-form">
						<div class="bookingtab">
						<form  method="POST" action="<?php echo $action; ?>" id="aspnetForm" class="validateForm">
								<input name="q" type="hidden" value="Flight">
								<input type="hidden" class="curUrl" name="curUrl" id="curUrl" value="">
								<div class="row">
									<div class="col-sm-12">
										<h4 data-translate="STRING_CONTACTDETAILS">Contact Details</h4>
										<hr>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group"><label data-translate="STRING_NAME">Name</label> 
										<input name="fullName" type="text" id="fullName" class="form-control" data-validation="required" placeholder="Name" data-type="string"></div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group"><label>Phone / Mobile</label> <input name="phoneNum" type="text" id="ctl279_phoneNum" class="form-control" data-validation="required" placeholder="Phone / Mobile" data-type="number"></div>
									</div>
									<div class="col-sm-6">
										<div class="form-group"><label>E-mail</label> 
										<input name="email" type="text" id="mail" class="form-control" data-validation="required" placeholder="Email" data-type="email">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<h4 data-translate="STRING_HOLIDAYDETAILS">Flight Details</h4>
										<hr>
									</div>
								</div>
								<div class="row">
								<div class="col-sm-12">
									<ul class="list-inline trip-section">
										<li>
											<input id="rTripBtn1"  class="form-control" type="radio" value="Round Trip" name="JourneyType" checked="checked">
											</input><label for="rTripBtn1" data-translate="STRING_ROUNDTRIP">Round Trip</label>
										</li>
											<li>
											<input id="oTripBtn1" class="form-control" type="radio" value="One-way" name="JourneyType"></input>
											<label for="oTripBtn1" data-translate="STRING_ONEWAY">One-way</label>
											</li>
										</ul>
									</div>
								</div>
								<br/>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group"><label data-translate="STRING_DATEOFTRAVEL">Depart From</label> 
										<input type="text" class="form-control"   name="depart" placeholder="Depart From">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group"><label data-translate="STRING_DATEOFTRAVEL">Depart To</label> 
										<input type="text" class="form-control"  name="arrival" placeholder="Depart To" ></div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group"><label data-translate="STRING_DATEOFTRAVEL">Depart Date</label> 
										<input type="date" class="form-control"   name="depart_date" placeholder="DDepart Date">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group"><label data-translate="STRING_DATEOFTRAVEL">Return Date</label> 
										<input type="date" class="form-control"  name="return_date" placeholder="Return Date" ></div>
									</div>
								</div>
								
								<div class="row">
								<div class="col-sm-6">
										<div class="form-group"><label data-translate="STRING_DATEOFTRAVEL">Airline Name</label> 
										<input type="text" class="form-control"   name="airline_name" placeholder="Airline Name">
										</div>
									</div>
									
									<div class="col-sm-6">
										<div class="form-group">
											<label data-translate="STRING_ADULT">Class</label> 
											<select name="class" id="ctl279_adult" class="form-control">
												<option value="Economy">Economy</option>
												<option value="Busines">Busines</option>
												
											</select>
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group"><label data-translate="STRING_ADDITIONALREQ">Additional requirements</label> <textarea name="message" id="ctl279_message" class="form-control" data-validation="required" rows="4" data-type="string"></textarea></div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											 <?php echo form_error('g-recaptcha-response'); ?>
											<?php echo $recaptcha_html;?>
										</div>
									</div>
									<div class="col-md-6">
										<ul class="list-inline pull-right">
								<!--<li>
								<input type="button" name="ctl279$btnResetCaptcha" value="Reset" onclick="javascript:__doPostBack(&#39;ctl279$btnResetCaptcha&#39;,&#39;&#39;)" id="ctl279_btnResetCaptcha" class="button reset btn btn-warning mt-15" type="reset" value="Reset" />
								</li>-->
											<li><input type="submit" name="ctl279$btnNewsLetterSubmit" value="Submit" id="ctl279_btnNewsLetterSubmit" class="btn btn-warning mt-15"></li>
										</ul>
									</div>
								</div>
								<input name="ctl279$tourtitle" type="hidden" id="ctl279_tourtitle" class="tourtitle" value="MU1EK - Cost Saver 08D/05N TURKEY with BOSPHORUS CRUISE ">
								<div class="aspNetHidden"><input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="80A69F75"> <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="MoZALHyWz7DQVNoKIVGoZh/8yYON+vBWKeVEvdtCU2asFlAWhQqJlgCffPHKG9qBW2qyDDcFdAV5SGoDnnsMEc032+6qXUfJkUIw/+Ot30kSNygjen/tquKuVX1uagbAM5IImlEPACW+40dn1/5d1DAq81hmQS086lzVav0XRryrpohVSemaIi/AKwUjlOi6ssyAYr1aSsB5jk5yhm4hQ9drSiZrvaNGOBe10coW3ilU4u1fPSZN2p2l+lnOg3+V/KUVBvcFqC13SBJRjTIWtYdfeE6XA3tBt1aFpmdTeRiB8pZMn0sX+rNjOyzohwQ5izJgUiBlgS2JtDYNmoCogBps/XLucSDpikUUPYQDmTo="></div>
							</form>
						</div>
					</div>