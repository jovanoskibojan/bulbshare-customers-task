<div id="{{ $modalID }}" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modalHeader">
            <span class="close">&times;</span>
            <p>{{ $modalButton }}</p>
        </div>
        <div class="modalBody">
            <form id="{{ $formID }}">
                <div>
                    <div><label for="{{ $id_prefix }}company">Company</label></div>
                    <div>
                        <input type="text" id="{{ $id_prefix }}company" name="company" required>
                        <p></p>
                    </div>
                </div>
                <div>
                    <div><label for="{{ $id_prefix }}first_name">First name</label></div>
                    <div>
                        <input type="text" id="{{ $id_prefix }}first_name" name="first_name" required>
                        <p></p>
                    </div>
                </div>
                <div>
                    <div><label for="{{ $id_prefix }}last_name">Last name</label></div>
                    <div>
                        <input type="text" id="{{ $id_prefix }}last_name" name="last_name" required>
                        <p></p>
                    </div>
                </div>
                <div>
                    <div><label for="{{ $id_prefix }}email_address">Email address</label></div>
                    <div><input type="text" id="{{ $id_prefix }}email_address" name="email_address"></div>
                </div>
                <div>
                    <div><label for="{{ $id_prefix }}job_title">Job title</label></div>
                    <div><input type="text" id="{{ $id_prefix }}job_title" name="job_title"></div>
                </div>
                <div>
                    <div><label for="{{ $id_prefix }}business_phone">Business phone</label></div>
                    <div><input type="text" id="{{ $id_prefix }}business_phone" name="business_phone"></div>
                </div>
                <div>
                    <div><label for="{{ $id_prefix }}address">Address</label></div>
                    <div><input type="text" id="{{ $id_prefix }}address" name="address"></div>
                </div>
                <div>
                    <div><label for="{{ $id_prefix }}city">City</label></div>
                    <div><input type="text" id="{{ $id_prefix }}city" name="city"></div>
                </div>
                <div>
                    <div><label for="{{ $id_prefix }}state_province">State/Province</label></div>
                    <div><input type="text" id="{{ $id_prefix }}state_province" name="state_province"></div>
                </div>
                <div>
                    <div><label for="{{ $id_prefix }}zip_postal_code">Zip/Postal code</label></div>
                    <div><input type="text" id="{{ $id_prefix }}zip_postal_code" name="zip_postal_code"></div>
                </div>
                <div>
                    <div><label for="{{ $id_prefix }}country_region">Country region</label></div>
                    <div><input type="text" id="{{ $id_prefix }}country_region" name="country_region"></div>
                </div>
                <input type="hidden" id="{{ $id_prefix }}id" name="id">

            </form>
        </div>
        <div class="modalFooter">
            <input type="button" id="{{ $modalButtonID }}" value="{{ $modalButton }}" class="button.dt-button">
        </div>
    </div>

</div>
