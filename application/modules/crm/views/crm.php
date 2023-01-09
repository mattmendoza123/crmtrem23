<div class="page-wrapper" >
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor page-title-text">CRM</h3>
            </div>
            <div class="col-md-7 align-self-center text-right">
            <!-- <button type="button" id="excsv"><i class="fa fa-plus-circle"></i> Export to CSV </button> -->
            <button onclick="ExportToExcel('xlsx')" class="btn atm-button"><img src="https://greenifymyhome.co.uk/Invalidclicks/assets/css/icons/new-icons/002-export.png" style="width: 10%;"> Export table to excel</img></button>
            <button type="button" class="btn atm-button" data-toggle="modal" data-target="#AddUserModal"><img src="https://greenifymyhome.co.uk/Invalidclicks/assets/css/icons/new-icons/001-add-user.png" style="width: 20%;"> Add Contact </img></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-12-no-padding">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="crm_datatable" class="table table-striped jambo_table bulk_action dt-responsive" style="width: 100% !important;">
                                <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Skype</th>
                                        <th>Tags</th>
                                        <th>Country</th>
                                        <th>Website</th>
                                        <th>Model</th>
                                        <th>Geo</th>
                                        <th>Traffic Source</th>
                                        <th>AM</th>
                                        <th>Comment</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add User Modal -->
<div class="modal fade" id="AddUserModal" tabindex="-1" role="dialog" aria-labelledby="AddUserModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="AddUserModalTitle"><img src="https://greenifymyhome.co.uk/Invalidclicks/assets/css/icons/new-icons/001-add-users.png" style="width: 20%;">&nbsp;&nbsp;Add User </img></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>            
                    <div class="modal-body">
                    <form class="form-horizontal form-material" method="post" enctype="multipart/form-data" id="adduser"  action="<?= base_url("crm/adduser"); ?>">

                    <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="date_created">Date Created</label>
                                    <input id="date_created" class="form-control" type="date"  name="date_created" value="<?php echo date('Y-m-d'); ?>" disabled/>
                            </div>
                        </div>
                    </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="company">Company</label>
                                    <input id="company" class="form-control" type="text"  name="company" value="" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="website">Website</label>
                                    <input id="website" class="form-control" type="text"  name="website" value="" required/>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input id="first_name" class="form-control" type="text"  name="first_name" value="" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input id="last_name" class="form-control" type="text"  name="last_name" value="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email">Email Address</label>
                                    <input id="email" class="form-control" type="text"  name="email" value="" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="skype">Skype/Telegram</label>
                                    <input id="skype" class="form-control" type="text"  name="skype" value="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <!-- <select id="country" class="form-control" name="country"><option>Select Country</option></select> -->
                                    <!-- <input id="city" class="form-control" type="text" name="city" value="" required/> -->
                                    <select id="country" name="country" class="form-control">
                                        <option selected hidden>-Please select-</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Åland Islands">Åland Islands</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guernsey">Guernsey</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-bissau">Guinea-bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jersey">Jersey</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macao">Macao</option>
                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Helena">Saint Helena</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-leste">Timor-leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="am">AM</label>
                                    <select id="am" name="am" class="form-control">
                                        <option selected hidden>-Please select-</option>
                                        <option value="JP">JP</option>
                                        <option value="Matt">Matt</option>
                                        <option value="Nina">Nina</option>
                                    </select>
                                </div>
                            </div>
                        </div>

            

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tags">Tags</label>
                                    <br>
                                    <select id="tags[]" class="form-control" name="tags[]" multiple multiselect-search="true">
                                    <option>&nbsp;Dating</option>
                                    <option>&nbsp;Sweeps</option>
                                    <option>&nbsp;Nutra</option>
                                    <option>&nbsp;Finance</option>
                                    <option>&nbsp;Home Improvement</option>
                                    <option>&nbsp;Gambling</option>
                                    <option>&nbsp;E-commerce</option>
                                    <option>&nbsp;Entertainment</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="model">Model</label>
                                    <br>
                                    <select id="model[]" class="form-control" name="model[]" multiple multiselect-search="true">
                                    <option>&nbsp;CPC</option>
                                    <option>&nbsp;CPM</option>
                                    <option>&nbsp;CPA</option>
                                    <option>&nbsp;CPL</option>
                                    <option>&nbsp;RevShare</option>
                                    <option>&nbsp;API</option>
                                    </select>
                                    <!-- <input id="country" class="form-control" type="text"  name="country" value="" required/> -->
                                </div>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                            <div class="col-md-6">
                                    <label for="geo">GEO</label>
                                    <br>
                                    <select id="geo[]" class="form-control" name="geo[]" multiple multiselect-search="true">
                                    <option>&nbsp;EUROPE</option>
                                    <option>&nbsp;LATAM</option>
                                    <option>&nbsp;MENA</option>
                                    <option>&nbsp;NORDICS</option>
                                    <option>&nbsp;WW</option>
                                    <option>&nbsp;AC</option>
                                    <option>&nbsp;AD</option>
                                    <option>&nbsp;AE</option>
                                    <option>&nbsp;AF</option>
                                    <option>&nbsp;AG</option>
                                    <option>&nbsp;AI</option>
                                    <option>&nbsp;AL</option>
                                    <option>&nbsp;AM</option>
                                    <option>&nbsp;AO</option>
                                    <option>&nbsp;AQ</option>
                                    <option>&nbsp;AR</option>
                                    <option>&nbsp;AS</option>
                                    <option>&nbsp;AT</option>
                                    <option>&nbsp;AU</option>
                                    <option>&nbsp;AW</option>
                                    <option>&nbsp;AX</option>
                                    <option>&nbsp;AZ</option>
                                    <option>&nbsp;BA</option>
                                    <option>&nbsp;BB</option>
                                    <option>&nbsp;BD</option>
                                    <option>&nbsp;BE</option>
                                    <option>&nbsp;BF</option>
                                    <option>&nbsp;BG</option>
                                    <option>&nbsp;BH</option>
                                    <option>&nbsp;BI</option>
                                    <option>&nbsp;BJ</option>
                                    <option>&nbsp;BM</option>
                                    <option>&nbsp;BN</option>
                                    <option>&nbsp;BO</option>
                                    <option>&nbsp;BQ</option>
                                    <option>&nbsp;BR</option>
                                    <option>&nbsp;BS</option>
                                    <option>&nbsp;BT</option>
                                    <option>&nbsp;BW</option>
                                    <option>&nbsp;BY</option>
                                    <option>&nbsp;BZ</option>
                                    <option>&nbsp;CA</option>
                                    <option>&nbsp;CC</option>
                                    <option>&nbsp;CD</option>
                                    <option>&nbsp;CF</option>
                                    <option>&nbsp;CG</option>
                                    <option>&nbsp;CH</option>
                                    <option>&nbsp;CI</option>
                                    <option>&nbsp;CK</option>
                                    <option>&nbsp;CL</option>
                                    <option>&nbsp;CM</option>
                                    <option>&nbsp;CN</option>
                                    <option>&nbsp;CO</option>
                                    <option>&nbsp;CR</option>
                                    <option>&nbsp;CU</option>
                                    <option>&nbsp;CV</option>
                                    <option>&nbsp;CW</option>
                                    <option>&nbsp;CX</option>
                                    <option>&nbsp;CY</option>
                                    <option>&nbsp;CZ</option>
                                    <option>&nbsp;DE</option>
                                    <option>&nbsp;DJ</option>
                                    <option>&nbsp;DK</option>
                                    <option>&nbsp;DM</option>
                                    <option>&nbsp;DO</option>
                                    <option>&nbsp;DZ</option>
                                    <option>&nbsp;EC</option>
                                    <option>&nbsp;EE</option>
                                    <option>&nbsp;GB</option>
                                    <option>&nbsp;ES</option>
                                    <option>&nbsp;ET</option>
                                    <option>&nbsp;EU</option>
                                    <option>&nbsp;FI</option>
                                    <option>&nbsp;FJ</option>
                                    <option>&nbsp;FK</option>
                                    <option>&nbsp;FM</option>
                                    <option>&nbsp;FO</option>
                                    <option>&nbsp;FR</option>
                                    <option>&nbsp;GA</option>
                                    <option>&nbsp;GD</option>
                                    <option>&nbsp;GE</option>
                                    <option>&nbsp;GF</option>
                                    <option>&nbsp;GG</option>
                                    <option>&nbsp;GB</option>
                                    <option>&nbsp;GH</option>
                                    <option>&nbsp;GI</option>
                                    <option>&nbsp;GL</option>
                                    <option>&nbsp;GM</option>
                                    <option>&nbsp;GN</option>
                                    <option>&nbsp;GP</option>
                                    <option>&nbsp;GQ</option>
                                    <option>&nbsp;GR</option>
                                    <option>&nbsp;GS</option>
                                    <option>&nbsp;GT</option>
                                    <option>&nbsp;GU</option>
                                    <option>&nbsp;GW</option>
                                    <option>&nbsp;GY</option>
                                    <option>&nbsp;HK</option>
                                    <option>&nbsp;HM</option>
                                    <option>&nbsp;HN</option>
                                    <option>&nbsp;HR</option>
                                    <option>&nbsp;HT</option>
                                    <option>&nbsp;HU</option>
                                    <option>&nbsp;ID</option>
                                    <option>&nbsp;IE</option>
                                    <option>&nbsp;IL</option>
                                    <option>&nbsp;IM</option>
                                    <option>&nbsp;IN</option>
                                    <option>&nbsp;IO</option>
                                    <option>&nbsp;IQ</option>
                                    <option>&nbsp;IR</option>
                                    <option>&nbsp;IS</option>
                                    <option>&nbsp;IT</option>
                                    <option>&nbsp;JE</option>
                                    <option>&nbsp;JM</option>
                                    <option>&nbsp;JO</option>
                                    <option>&nbsp;JP</option>
                                    <option>&nbsp;KE</option>
                                    <option>&nbsp;KG</option>
                                    <option>&nbsp;KH</option>
                                    <option>&nbsp;KI</option>
                                    <option>&nbsp;KM</option>
                                    <option>&nbsp;KN</option>
                                    <option>&nbsp;KP</option>
                                    <option>&nbsp;KR</option>
                                    <option>&nbsp;KW</option>
                                    <option>&nbsp;KY</option>
                                    <option>&nbsp;KZ</option>
                                    <option>&nbsp;LA</option>
                                    <option>&nbsp;LB</option>
                                    <option>&nbsp;LC</option>
                                    <option>&nbsp;LI</option>
                                    <option>&nbsp;LK</option>
                                    <option>&nbsp;LR</option>
                                    <option>&nbsp;LS</option>
                                    <option>&nbsp;LT</option>
                                    <option>&nbsp;LU</option>
                                    <option>&nbsp;LV</option>
                                    <option>&nbsp;LY</option>
                                    <option>&nbsp;MA</option>
                                    <option>&nbsp;MC</option>
                                    <option>&nbsp;MD</option>
                                    <option>&nbsp;ME</option>
                                    <option>&nbsp;MG</option>
                                    <option>&nbsp;MH</option>
                                    <option>&nbsp;MK</option>
                                    <option>&nbsp;ML</option>
                                    <option>&nbsp;MM</option>
                                    <option>&nbsp;MN</option>
                                    <option>&nbsp;MO</option>
                                    <option>&nbsp;MP</option>
                                    <option>&nbsp;MQ</option>
                                    <option>&nbsp;MR</option>
                                    <option>&nbsp;MS</option>
                                    <option>&nbsp;MT</option>
                                    <option>&nbsp;MU</option>
                                    <option>&nbsp;MV</option>
                                    <option>&nbsp;MW</option>
                                    <option>&nbsp;MX</option>
                                    <option>&nbsp;MY</option>
                                    <option>&nbsp;MZ</option>
                                    <option>&nbsp;NA</option>
                                    <option>&nbsp;NC</option>
                                    <option>&nbsp;NE</option>
                                    <option>&nbsp;NF</option>
                                    <option>&nbsp;NG</option>
                                    <option>&nbsp;NI</option>
                                    <option>&nbsp;NL</option>
                                    <option>&nbsp;NO</option>
                                    <option>&nbsp;NP</option>
                                    <option>&nbsp;NR</option>
                                    <option>&nbsp;NU</option>
                                    <option>&nbsp;NZ</option>
                                    <option>&nbsp;OM</option>
                                    <option>&nbsp;PA</option>
                                    <option>&nbsp;PE</option>
                                    <option>&nbsp;PF</option>
                                    <option>&nbsp;PG</option>
                                    <option>&nbsp;PH</option>
                                    <option>&nbsp;PK</option>
                                    <option>&nbsp;PL</option>
                                    <option>&nbsp;PM</option>
                                    <option>&nbsp;PN</option>
                                    <option>&nbsp;PR</option>
                                    <option>&nbsp;PS</option>
                                    <option>&nbsp;PT</option>
                                    <option>&nbsp;PW</option>
                                    <option>&nbsp;PY</option>
                                    <option>&nbsp;QA</option>
                                    <option>&nbsp;RE</option>
                                    <option>&nbsp;RO</option>
                                    <option>&nbsp;RS</option>
                                    <option>&nbsp;RU</option>
                                    <option>&nbsp;RW</option>
                                    <option>&nbsp;SA</option>
                                    <option>&nbsp;SB</option>
                                    <option>&nbsp;SC</option>
                                    <option>&nbsp;SD</option>
                                    <option>&nbsp;SE</option>
                                    <option>&nbsp;SG</option>
                                    <option>&nbsp;SH</option>
  			                        <option>&nbsp;SI</option>
                                    <option>&nbsp;SK</option>
                                    <option>&nbsp;SL</option>
                                    <option>&nbsp;SM</option>
                                    <option>&nbsp;SN</option>
                                    <option>&nbsp;SO</option>
                                    <option>&nbsp;SR</option>
                                    <option>&nbsp;SS</option>
                                    <option>&nbsp;ST</option>
                                    <option>&nbsp;SU</option>
                                    <option>&nbsp;SV</option>
                                    <option>&nbsp;SX</option>
                                    <option>&nbsp;SY</option>
                                    <option>&nbsp;SZ</option>
                                    <option>&nbsp;TC</option>
                                    <option>&nbsp;TD</option>
                                    <option>&nbsp;TF</option>
                                    <option>&nbsp;TG</option>
                                    <option>&nbsp;TH</option>
                                    <option>&nbsp;TJ</option>
                                    <option>&nbsp;TK</option>
                                    <option>&nbsp;TL</option>
                                    <option>&nbsp;TM</option>
                                    <option>&nbsp;TN</option>
                                    <option>&nbsp;TO</option>
                                    <option>&nbsp;TR</option>
                                    <option>&nbsp;TT</option>
                                    <option>&nbsp;TV</option>
                                    <option>&nbsp;TW</option>
                                    <option>&nbsp;TZ</option>
                                    <option>&nbsp;UA</option>
                                    <option>&nbsp;UG</option>
                                    <option>&nbsp;UK</option>
                                    <option>&nbsp;US</option>
                                    <option>&nbsp;UY</option>
                                    <option>&nbsp;UZ</option>
                                    <option>&nbsp;VA</option>
                                    <option>&nbsp;VC</option>
                                    <option>&nbsp;VE</option>
                                    <option>&nbsp;VG</option>
                                    <option>&nbsp;VI</option>
                                    <option>&nbsp;VN</option>
                                    <option>&nbsp;VU</option>
                                    <option>&nbsp;WF</option>
                                    <option>&nbsp;WS</option>
                                    <option>&nbsp;YE</option>
                                    <option>&nbsp;YT</option>
                                    <option>&nbsp;ZA</option>
                                    <option>&nbsp;ZM</option>
                                    <option>&nbsp;ZW</option>
                                    </select>
                                    <!-- <input id="state" class="form-control" type="text" name="state" value="" required/> -->
                                </div>
                                <div class="col-md-6">
                                 <label for="traffic_source">Traffic Source</label>
                                    <br>
                                    <select id="traffic_source[]" class="form-control" name="traffic_source[]" multiple multiselect-search="true">
                                    <option>&nbsp;Facebook</option>
                                    <option>&nbsp;Banner</option>
                                    <option>&nbsp;Email</option>
                                    <option>&nbsp;Native</option>
                                    <option>&nbsp;Mobile</option>
                                    <option>&nbsp;Push</option>
                                    </select>
                                    <!-- <label for="traffic_source">Traffic Source</label>
                                    <br>
                                    <label for="facebook">Facebook</label>
                                    <input type="checkbox" name="traffic_source[]" id="traffic_source[]" value="Facebook"></td> 
                                    <label for="banner">Banner</label>
                                    <input type="checkbox" name="traffic_source[]" id="traffic_source[]"  value="Banner"></td> 
                                    <label for="email">Email</label>
                                    <input type="checkbox" name="traffic_source[]" id="traffic_source[]"  value="Email"></td>  -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                <label for="business_card">Add Business Card</label>
                                            <div class="input-group mb-3 up-business-card">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupFileAddon01" ><i class="fas fa-upload"></i></span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="form-control custom-file-input" id="business_card" name="business_card" value="" aria-describedby="inputGroupFileAddon01" required>
                                                    <label class="custom-file-label form-control" for="inputGroupFile01"> &nbsp; &nbsp; Choose Business Card</label>
                                                </div>
                                            </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <input id="country" class="form-control" type="text"  name="country" value="" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="state">State</label>
                                    <input id="state" class="form-control" type="text" name="state" value="" required/>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="comment">Comment</label>
                                    <textarea id="comment" class="form-control" name="comment" value="" rows="4" cols="50"></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn atm-button" id="submit" type="submit"><i class="fa fa-plus-circle"></i> Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Update Modal -->
<div class="modal fade" id="UpdateUsers" tabindex="-1" role="dialog" aria-labelledby="UpdateUserModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="UpdateUserModalTitle"><img src="https://greenifymyhome.co.uk/Invalidclicks/assets/css/icons/new-icons/001-edit-user.png" style="width: 15%;">&nbsp;&nbsp;Update User</img></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>            
                    <div class="modal-body">
                    <form  method="post" enctype="multipart/form-data" action="<?= base_url("crm/updatecrm"); ?>" id="updatecrm">
                    <input type="hidden" class="form-control" id="fk_user_id" name="fk_user_id">
                    <input type="hidden" class="form-control" id="crm_id" name="crm_id">
                     <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="date_created">Date Created</label>
                                    <input id="date_created" class="form-control" type="date"  name="date_created" value="<?php echo date('Y-m-d'); ?>" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="company">Company</label>
                                    <input id="u_company" class="form-control" type="text"  name="u_company" value="" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="website">Website</label>
                                    <input id="u_website" class="form-control" type="text"  name="u_website" value="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input id="u_first_name" class="form-control" type="text"  name="u_first_name" value="" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input id="u_last_name" class="form-control" type="text"  name="u_last_name" value="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email">Email Address</label>
                                    <input id="u_email" class="form-control" type="text"  name="u_email" value="" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="skype">Skype/Telegram</label>
                                    <input id="u_skype" class="form-control" type="text"  name="u_skype" value="" required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <select id="u_country" name="u_country" class="form-control">
                                        <option selected hidden>-Please select-</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Åland Islands">Åland Islands</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guernsey">Guernsey</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-bissau">Guinea-bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jersey">Jersey</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macao">Macao</option>
                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Helena">Saint Helena</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-leste">Timor-leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="am">AM</label>
                                    <select id="u_am" name="u_am" class="form-control">
                                        <option selected hidden>-Please select-</option>
                                        <option value="JP">JP</option>
                                        <option value="Matt">Matt</option>
                                        <option value="Nina">Nina</option>
                                    </select>
                                </div>
                            </div>
                        </div>

            

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tags">Tags</label> 
                                   
                                    <div id="tags1">
                                    <input type="hidden" class="hidden" id="u_tags[]" name="u_tags[]" value="">
                                    <textarea class="form-control" onclick="tags()" class="button"  id="u_tags[]" rows="4" cols="50"></textarea>
                                    <!-- <input type="button" class="form-control" onclick="tags()" class="button" name="tags[]" id="tags[]" style="text-align: left !important; overflow: hidden; text-overflow: ellipsis; word-wrap: break-word;"> -->
                                    </div>
                                    <div id="tags2" style="display:none;">
                                    <select  name="u_tags[]" multiple multiselect-search="true">
                                    <option>&nbsp;Dating</option>
                                    <option>&nbsp;Sweeps</option>
                                    <option>&nbsp;Nutra</option>
                                    <option>&nbsp;Finance</option>
                                    <option>&nbsp;Home Improvement</option>
                                    <option>&nbsp;Gambling</option>
                                    <option>&nbsp;E-commerce</option>
                                    <option>&nbsp;Entertainment</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="model">Model</label> 
                                    <div id="model1">
                                    <input type="hidden" class="hidden1" id="u_model[]" name="u_model[]" value="">
                                    <textarea class="form-control" onclick="model()" class="button" id="u_model[]" rows="4" cols="50"></textarea>
                                    <!-- <input type="button" class="form-control" onclick="model()" class="button" name="model[]" id="model[]" style="text-align: left !important; overflow: hidden; text-overflow: ellipsis; word-wrap: break-word;"> -->
                                    </div>
                                    <div id="model2" style="display:none;">
                                    <select name="u_model[]" multiple multiselect-search="true">
                                    <option>&nbsp;CPC</option>
                                    <option>&nbsp;CPM</option>
                                    <option>&nbsp;CPA</option>
                                    <option>&nbsp;CPL</option>
                                    <option>&nbsp;RevShare</option>
                                    <option>&nbsp;API</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                             <div class="row">
                             <div class="col-md-6">
                                    <label for="geo">Geo</label> 
                                    <div id="geo1">
                                    <input type="hidden" class="hidden2" id="u_geo[]" name="u_geo[]" value="">
                                    <textarea class="form-control" onclick="geo()" class="button" id="u_geo[]" rows="4" cols="50"></textarea>
                                    <!-- <input type="button" class="form-control" onclick="geo()" class="button" name="geo[]" id="geo[]" style="text-align: left !important; overflow: hidden; text-overflow: ellipsis; word-wrap: break-word;"> -->
                                    </div>
                                    <div id="geo2" style="display:none;">
                                    <select name="u_geo[]" multiple multiselect-search="true">
                                    <option>&nbsp;EUROPE</option>
                                    <option>&nbsp;LATAM</option>
                                    <option>&nbsp;MENA</option>
                                    <option>&nbsp;NORDICS</option>
                                    <option>&nbsp;WW</option>
                                    <option>&nbsp;AC</option>
                                    <option>&nbsp;AD</option>
                                    <option>&nbsp;AE</option>
                                    <option>&nbsp;AF</option>
                                    <option>&nbsp;AG</option>
                                    <option>&nbsp;AI</option>
                                    <option>&nbsp;AL</option>
                                    <option>&nbsp;AM</option>
                                    <option>&nbsp;AO</option>
                                    <option>&nbsp;AQ</option>
                                    <option>&nbsp;AR</option>
                                    <option>&nbsp;AS</option>
                                    <option>&nbsp;AT</option>
                                    <option>&nbsp;AU</option>
                                    <option>&nbsp;AW</option>
                                    <option>&nbsp;AX</option>
                                    <option>&nbsp;AZ</option>
                                    <option>&nbsp;BA</option>
                                    <option>&nbsp;BB</option>
                                    <option>&nbsp;BD</option>
                                    <option>&nbsp;BE</option>
                                    <option>&nbsp;BF</option>
                                    <option>&nbsp;BG</option>
                                    <option>&nbsp;BH</option>
                                    <option>&nbsp;BI</option>
                                    <option>&nbsp;BJ</option>
                                    <option>&nbsp;BM</option>
                                    <option>&nbsp;BN</option>
                                    <option>&nbsp;BO</option>
                                    <option>&nbsp;BQ</option>
                                    <option>&nbsp;BR</option>
                                    <option>&nbsp;BS</option>
                                    <option>&nbsp;BT</option>
                                    <option>&nbsp;BW</option>
                                    <option>&nbsp;BY</option>
                                    <option>&nbsp;BZ</option>
                                    <option>&nbsp;CA</option>
                                    <option>&nbsp;CC</option>
                                    <option>&nbsp;CD</option>
                                    <option>&nbsp;CF</option>
                                    <option>&nbsp;CG</option>
                                    <option>&nbsp;CH</option>
                                    <option>&nbsp;CI</option>
                                    <option>&nbsp;CK</option>
                                    <option>&nbsp;CL</option>
                                    <option>&nbsp;CM</option>
                                    <option>&nbsp;CN</option>
                                    <option>&nbsp;CO</option>
                                    <option>&nbsp;CR</option>
                                    <option>&nbsp;CU</option>
                                    <option>&nbsp;CV</option>
                                    <option>&nbsp;CW</option>
                                    <option>&nbsp;CX</option>
                                    <option>&nbsp;CY</option>
                                    <option>&nbsp;CZ</option>
                                    <option>&nbsp;DE</option>
                                    <option>&nbsp;DJ</option>
                                    <option>&nbsp;DK</option>
                                    <option>&nbsp;DM</option>
                                    <option>&nbsp;DO</option>
                                    <option>&nbsp;DZ</option>
                                    <option>&nbsp;EC</option>
                                    <option>&nbsp;EE</option>
                                    <option>&nbsp;GB</option>
                                    <option>&nbsp;ES</option>
                                    <option>&nbsp;ET</option>
                                    <option>&nbsp;EU</option>
                                    <option>&nbsp;FI</option>
                                    <option>&nbsp;FJ</option>
                                    <option>&nbsp;FK</option>
                                    <option>&nbsp;FM</option>
                                    <option>&nbsp;FO</option>
                                    <option>&nbsp;FR</option>
                                    <option>&nbsp;GA</option>
                                    <option>&nbsp;GD</option>
                                    <option>&nbsp;GE</option>
                                    <option>&nbsp;GF</option>
                                    <option>&nbsp;GG</option>
                                    <option>&nbsp;GB</option>
                                    <option>&nbsp;GH</option>
                                    <option>&nbsp;GI</option>
                                    <option>&nbsp;GL</option>
                                    <option>&nbsp;GM</option>
                                    <option>&nbsp;GN</option>
                                    <option>&nbsp;GP</option>
                                    <option>&nbsp;GQ</option>
                                    <option>&nbsp;GR</option>
                                    <option>&nbsp;GS</option>
                                    <option>&nbsp;GT</option>
                                    <option>&nbsp;GU</option>
                                    <option>&nbsp;GW</option>
                                    <option>&nbsp;GY</option>
                                    <option>&nbsp;HK</option>
                                    <option>&nbsp;HM</option>
                                    <option>&nbsp;HN</option>
                                    <option>&nbsp;HR</option>
                                    <option>&nbsp;HT</option>
                                    <option>&nbsp;HU</option>
                                    <option>&nbsp;ID</option>
                                    <option>&nbsp;IE</option>
                                    <option>&nbsp;IL</option>
                                    <option>&nbsp;IM</option>
                                    <option>&nbsp;IN</option>
                                    <option>&nbsp;IO</option>
                                    <option>&nbsp;IQ</option>
                                    <option>&nbsp;IR</option>
                                    <option>&nbsp;IS</option>
                                    <option>&nbsp;IT</option>
                                    <option>&nbsp;JE</option>
                                    <option>&nbsp;JM</option>
                                    <option>&nbsp;JO</option>
                                    <option>&nbsp;JP</option>
                                    <option>&nbsp;KE</option>
                                    <option>&nbsp;KG</option>
                                    <option>&nbsp;KH</option>
                                    <option>&nbsp;KI</option>
                                    <option>&nbsp;KM</option>
                                    <option>&nbsp;KN</option>
                                    <option>&nbsp;KP</option>
                                    <option>&nbsp;KR</option>
                                    <option>&nbsp;KW</option>
                                    <option>&nbsp;KY</option>
                                    <option>&nbsp;KZ</option>
                                    <option>&nbsp;LA</option>
                                    <option>&nbsp;LB</option>
                                    <option>&nbsp;LC</option>
                                    <option>&nbsp;LI</option>
                                    <option>&nbsp;LK</option>
                                    <option>&nbsp;LR</option>
                                    <option>&nbsp;LS</option>
                                    <option>&nbsp;LT</option>
                                    <option>&nbsp;LU</option>
                                    <option>&nbsp;LV</option>
                                    <option>&nbsp;LY</option>
                                    <option>&nbsp;MA</option>
                                    <option>&nbsp;MC</option>
                                    <option>&nbsp;MD</option>
                                    <option>&nbsp;ME</option>
                                    <option>&nbsp;MG</option>
                                    <option>&nbsp;MH</option>
                                    <option>&nbsp;MK</option>
                                    <option>&nbsp;ML</option>
                                    <option>&nbsp;MM</option>
                                    <option>&nbsp;MN</option>
                                    <option>&nbsp;MO</option>
                                    <option>&nbsp;MP</option>
                                    <option>&nbsp;MQ</option>
                                    <option>&nbsp;MR</option>
                                    <option>&nbsp;MS</option>
                                    <option>&nbsp;MT</option>
                                    <option>&nbsp;MU</option>
                                    <option>&nbsp;MV</option>
                                    <option>&nbsp;MW</option>
                                    <option>&nbsp;MX</option>
                                    <option>&nbsp;MY</option>
                                    <option>&nbsp;MZ</option>
                                    <option>&nbsp;NA</option>
                                    <option>&nbsp;NC</option>
                                    <option>&nbsp;NE</option>
                                    <option>&nbsp;NF</option>
                                    <option>&nbsp;NG</option>
                                    <option>&nbsp;NI</option>
                                    <option>&nbsp;NL</option>
                                    <option>&nbsp;NO</option>
                                    <option>&nbsp;NP</option>
                                    <option>&nbsp;NR</option>
                                    <option>&nbsp;NU</option>
                                    <option>&nbsp;NZ</option>
                                    <option>&nbsp;OM</option>
                                    <option>&nbsp;PA</option>
                                    <option>&nbsp;PE</option>
                                    <option>&nbsp;PF</option>
                                    <option>&nbsp;PG</option>
                                    <option>&nbsp;PH</option>
                                    <option>&nbsp;PK</option>
                                    <option>&nbsp;PL</option>
                                    <option>&nbsp;PM</option>
                                    <option>&nbsp;PN</option>
                                    <option>&nbsp;PR</option>
                                    <option>&nbsp;PS</option>
                                    <option>&nbsp;PT</option>
                                    <option>&nbsp;PW</option>
                                    <option>&nbsp;PY</option>
                                    <option>&nbsp;QA</option>
                                    <option>&nbsp;RE</option>
                                    <option>&nbsp;RO</option>
                                    <option>&nbsp;RS</option>
                                    <option>&nbsp;RU</option>
                                    <option>&nbsp;RW</option>
                                    <option>&nbsp;SA</option>
                                    <option>&nbsp;SB</option>
                                    <option>&nbsp;SC</option>
                                    <option>&nbsp;SD</option>
                                    <option>&nbsp;SE</option>
                                    <option>&nbsp;SG</option>
                                    <option>&nbsp;SH</option>
  			                        <option>&nbsp;SI</option>
                                    <option>&nbsp;SK</option>
                                    <option>&nbsp;SL</option>
                                    <option>&nbsp;SM</option>
                                    <option>&nbsp;SN</option>
                                    <option>&nbsp;SO</option>
                                    <option>&nbsp;SR</option>
                                    <option>&nbsp;SS</option>
                                    <option>&nbsp;ST</option>
                                    <option>&nbsp;SU</option>
                                    <option>&nbsp;SV</option>
                                    <option>&nbsp;SX</option>
                                    <option>&nbsp;SY</option>
                                    <option>&nbsp;SZ</option>
                                    <option>&nbsp;TC</option>
                                    <option>&nbsp;TD</option>
                                    <option>&nbsp;TF</option>
                                    <option>&nbsp;TG</option>
                                    <option>&nbsp;TH</option>
                                    <option>&nbsp;TJ</option>
                                    <option>&nbsp;TK</option>
                                    <option>&nbsp;TL</option>
                                    <option>&nbsp;TM</option>
                                    <option>&nbsp;TN</option>
                                    <option>&nbsp;TO</option>
                                    <option>&nbsp;TR</option>
                                    <option>&nbsp;TT</option>
                                    <option>&nbsp;TV</option>
                                    <option>&nbsp;TW</option>
                                    <option>&nbsp;TZ</option>
                                    <option>&nbsp;UA</option>
                                    <option>&nbsp;UG</option>
                                    <option>&nbsp;UK</option>
                                    <option>&nbsp;US</option>
                                    <option>&nbsp;UY</option>
                                    <option>&nbsp;UZ</option>
                                    <option>&nbsp;VA</option>
                                    <option>&nbsp;VC</option>
                                    <option>&nbsp;VE</option>
                                    <option>&nbsp;VG</option>
                                    <option>&nbsp;VI</option>
                                    <option>&nbsp;VN</option>
                                    <option>&nbsp;VU</option>
                                    <option>&nbsp;WF</option>
                                    <option>&nbsp;WS</option>
                                    <option>&nbsp;YE</option>
                                    <option>&nbsp;YT</option>
                                    <option>&nbsp;ZA</option>
                                    <option>&nbsp;ZM</option>
                                    <option>&nbsp;ZW</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="traffic_source">Traffic Source</label> 
                                    <div id="traffic_source1">
                                    <input type="hidden" class="hidden3" id="u_traffic_source[]" name="u_traffic_source[]" value="">
                                    <textarea class="form-control" onclick="traffic_source()" class="button" id="u_traffic_source[]" rows="4" cols="50"></textarea>
                                    <!-- <input type="button" class="form-control" onclick="traffic_source()" class="button" name="traffic_source[]" id="traffic_source[]" style="text-align: left !important; overflow: hidden; text-overflow: ellipsis; word-wrap: break-word;"> -->
                                    </div>
                                    <div id="traffic_source2" style="display:none;">
                                    <select name="u_traffic_source[]" multiple multiselect-search="true">
                                    <option>&nbsp;Facebook</option>
                                    <option>&nbsp;Banner</option>
                                    <option>&nbsp;Email</option>
                                    <option>&nbsp;Native</option>
                                    <option>&nbsp;Mobile</option>
                                    <option>&nbsp;Push</option>
                                    </select>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <input id="country" class="form-control" type="text"  name="country" value="" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="state">State</label>
                                    <input id="state" class="form-control" type="text" name="state" value="" required/>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="business_card">Business Card</label>
                                    <div class="business-card">
                                        <img src="" id="u_business_card" name="u_business_card">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                            <div class="form-group col-md-12">
                                    <div class="input-group up-business-card">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="u_business_card" name="u_business_card" aria-describedby="book-btn">
                                            <label class="custom-file-label form-control" for="inputGroupFile04">Update Business Card</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="comment">Comment</label>
                                    <textarea id="u_comment" class="form-control" name="u_comment" value="" rows="4" cols="50"></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn atm-button" id="submit" type="submit"><i class="fa fa-plus-circle"></i> Save User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="ViewUsers" tabindex="-1" role="dialog" aria-labelledby="ViewUserModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ViewUserModalTitle"><img src="https://greenifymyhome.co.uk/Invalidclicks/assets/css/icons/new-icons/002-view-user.png" style="width: 18%;">&nbsp;&nbsp;View User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div> 
                
                
                    <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" id="viewcrm">
                    <input type="hidden" class="form-control" id="fk_user_id" name="fk_user_id">
                    <input type="hidden" class="form-control" id="crm_id" name="crm_id">
                     <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="date_created">Date Created</label>
                                    <input id="date_created" class="form-control" type="date"  name="date_created" value="<?php echo date('Y-m-d'); ?>" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="company">Company</label>
                                    <input id="v_company" class="form-control" type="text"  name="v_company" value="" disabled/>
                                </div>
                                <div class="col-md-6">
                                    <label for="website">Website</label>
                                    <input id="v_website" class="form-control" type="text"  name="v_website" value="" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input id="v_first_name" class="form-control" type="text"  name="v_first_name" value="" disabled/>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input id="v_last_name" class="form-control" type="text"  name="v_last_name" value="" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email">Email Address</label>
                                    <input id="v_email" class="form-control" type="text"  name="v_email" value="" disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="skype">Skype/Telegram</label>
                                    <input id="v_skype" class="form-control" type="text"  name="v_skype" value="" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <input id="v_country" name="v_country" class="form-control" type="text"   value="" disabled/>
                                </div>
                                <div class="col-md-6">
                                    <label for="am">AM</label>
                                    <input id="v_am" class="form-control" type="text"  name="v_am" value="" disabled/>
                                </div>
                            </div>
                        </div>

            

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tags">Tags</label> 
                                    <textarea id="v_tags[]" class="form-control" name="v_tags[]" value="" rows="4" cols="50" disabled></textarea>
                                    <!-- <input type="text" class="form-control" name="tags[]" id="tags[]" disabled> -->
                                </div>
                                <div class="col-md-6">
                                    <label for="model">Model</label> 
                                    <!-- <input id="model[]" class="form-control" type="text"  name="model[]" value="" disabled/> -->
                                    <textarea id="v_model[]" class="form-control" name="v_model[]" value="" rows="4" cols="50" disabled></textarea>
                                </div>
                        </div>
                        <br>
                        <div class="form-group">
                             <div class="row">
                             <div class="col-md-6">
                                    <label for="geo">Geo</label> 
                                    <textarea id="v_geo[]" class="form-control" name="v_geo[]" value="" rows="4" cols="50" disabled></textarea>
                                    <!--<input id="geo[]" class="form-control" type="text"  name="geo[]" value="" disabled/> -->
                                </div>
                                <div class="col-md-6">
                                    <label for="traffic_source">Traffic Source</label> 
                                    <textarea id="v_traffic_source[]" class="form-control" name="v_traffic_source[]" value="" rows="4" cols="50" disabled></textarea>
                                    <!-- <input id="traffic_source[]" class="form-control" type="text"  name="traffic_source[]" value="" disabled/> -->
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="business_card">Business Card</label>
                                    <div class="business-card">
                                        <img src="" id="v_business_card" name="v_business_card" style="width:100%;cursor:pointer" onclick="onClick(this)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
                            <!-- <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span> -->
                            <div class="w3-modal-content w3-animate-zoom">
                                <img id="img01" style="width:100%">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="business-card">
                                        <a id="down_business_card" class="btn btn-primary step-btn center_modalbutton"  href="" target="_blank" download>Download Business Card</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="comment">Comment</label>
                                    <textarea id="v_comment" class="form-control" name="v_comment" value="" rows="4" cols="50" disabled></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <!-- <button class="btn atm-button" id="btn_print" name="btn_print"  type="submit"><i class="fa fa-plus-circle"></i> Print</button> -->
                </div>
            </form>
        </div>
    </div>
</div>
