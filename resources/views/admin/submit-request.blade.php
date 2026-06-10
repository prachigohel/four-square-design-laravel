@extends('layouts.portal')

@section('title', 'Submit New Request - Four Square Designs Portal')

@section('content')
<form class="submit-request-container" method="POST" action="{{ route('portal.submit-request.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-section active" id="requiredInfoSection">
        <div class="section-header" id="requiredInfoHeader">
            <div class="section-title-group">
                <div class="status-icon success-icon"><i class="fas fa-check-circle"></i></div>
                <div>
                    <h2 class="section-title">Required Information</h2>
                    <p class="section-subtitle">Request Type, Cabinet brand, Door style, Ceiling height, Digital assets</p>
                </div>
            </div>
            <button type="button" class="toggle-section-btn" id="requiredInfoToggle"><i class="fas fa-minus"></i></button>
        </div>

        <div class="section-body" id="requiredInfoBody">
            <div class="form-grid">
                {{-- Request Title (left) + Request Type (right) --}}
                <div class="form-group">
                    <label>Request Title <span class="required-star">*</span></label>
                    <input type="text" name="title" placeholder="Enter request title" class="form-input" required>
                </div>

                <div class="form-group">
                    <label>Select Request Type <span class="required-star">*</span></label>
                    <select name="request_type" class="form-input">
                        <option value="">Select</option>
                        <option value="Design Start">Design Start</option>
                        <option value="Initial Packet">Initial Packet</option>
                        <option value="Conversion">Conversion</option>
                        <option value="Full Package">Full Package</option>
                        <option value="Design start & Initial Packet">Design start &amp; Initial Packet</option>
                        <option value="Other Services">Other Services</option>
                    </select>
                </div>

                {{-- Cabinet Brand — free text --}}
                <div class="form-group">
                    <label>Cabinet Brand <span class="required-star">*</span></label>
                    <input type="text" name="cabinet_brand" class="form-input" placeholder="Enter cabinet brand" required>
                </div>

                {{-- Door Style --}}
                <div class="form-group">
                    <label>Door Style <span class="required-star">*</span></label>
                    <input type="text" name="door_style" class="form-input" placeholder="Enter door style" required>
                </div>

                {{-- Finish --}}
                <div class="form-group">
                    <label>Finish <span class="required-star">*</span></label>
                    <input type="text" name="finish" class="form-input" placeholder="Enter finish" required>
                </div>

                <div class="form-group-row">
                    <div class="form-group">
                        <label>Ceiling Height</label>
                        <div class="input-with-label">
                            <input type="text" name="ceiling_height" placeholder="Size" class="form-input small">
                            <span>inches</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Wall Cabinet Height</label>
                        <div class="input-with-label">
                            <input type="text" name="wall_cabinet_height" placeholder="Size" class="form-input small">
                            <span>inches</span>
                        </div>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Measurements <span class="required-star">*</span></label>
                    <p class="field-info">Accepted file types are jpg, jpeg, png, webp, heic, pdf, xls, xlsx, csv, tsv, ppt, pptx, doc, docx, txt, .KIT and dsg file</p>
                    <div class="file-upload-area" id="uploadArea" style="cursor:pointer;position:relative;">
                        <input type="file" name="attachments[]" id="fileInput" multiple style="display:none;">
                        <div class="upload-plus">+</div>
                        <div id="fileList" style="margin-top:1rem;font-size:0.8rem;color:var(--primary-color);"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-section collapsed" id="additionalInfoSection">
        <div class="section-header" id="additionalInfoHeader">
            <div class="section-title-group">
                <div class="status-icon"><i class="fas fa-circle-dot"></i></div>
                <div>
                    <h2 class="section-title">Additional Information</h2>
                    <p class="section-subtitle">Appliances, Molding &amp; Door, Notes, Storage</p>
                </div>
            </div>
            <button type="button" class="toggle-section-btn" id="additionalInfoToggle"><i class="fas fa-plus"></i></button>
        </div>

        <div class="section-body" id="additionalInfoBody" style="display:none;">
            <div class="form-grid">

                {{-- Second Door + Soffits with conditional fields --}}
                <div class="checkbox-row">
                    <div class="cond-checkbox-col">
                        <div class="checkbox-group">
                            <input type="checkbox" name="additional_info[second_door]" id="secondDoor">
                            <label for="secondDoor">Second Door Style and Finish</label>
                        </div>
                        <input type="text" name="additional_info[second_door_text]" id="secondDoorText"
                               class="form-input cond-field" placeholder="Secondary Door Style and Finish"
                               style="display:none;margin-top:0.75rem;">
                    </div>
                    <div class="cond-checkbox-col">
                        <div class="checkbox-group">
                            <input type="checkbox" name="additional_info[soffits]" id="soffits">
                            <label for="soffits">Soffits</label>
                        </div>
                        <div id="soffitsFields" style="display:none;margin-top:0.75rem;">
                            <div style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap;">
                                <div style="display:flex;align-items:center;gap:0.5rem;">
                                    <strong style="font-size:0.85rem;white-space:nowrap;">Width:</strong>
                                    <input type="text" name="additional_info[soffits_width]" class="form-input mini" placeholder="">
                                    <span style="color:var(--text-muted);font-size:0.85rem;">inches</span>
                                </div>
                                <div style="display:flex;align-items:center;gap:0.5rem;">
                                    <strong style="font-size:0.85rem;white-space:nowrap;">Height:</strong>
                                    <input type="text" name="additional_info[soffits_height]" class="form-input mini" placeholder="">
                                    <span style="color:var(--text-muted);font-size:0.85rem;">inches</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group-row full-width">
                    <div class="form-group">
                        <label>Door Finish</label>
                        <div class="multi-input">
                            <div class="input-unit"><span>Wall:</span> <input type="text" name="additional_info[door_finish_wall]" class="form-input mini"></div>
                            <div class="input-unit"><span>Base:</span> <input type="text" name="additional_info[door_finish_base]" class="form-input mini"></div>
                            <div class="input-unit"><span>Island:</span> <input type="text" name="additional_info[door_finish_island]" class="form-input mini"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Decoration</label>
                        <select name="additional_info[decoration]" class="form-input">
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>

                {{-- Sink: searchable dropdown + "Others" text input --}}
                <div class="form-group full-width">
                    <label>Sink</label>
                    <div style="display:flex;align-items:flex-start;gap:1rem;flex-wrap:wrap;">
                        <div class="custom-select-wrapper" style="width:260px;">
                            <div class="custom-select-trigger form-input">
                                <span class="custom-select-label">Select</span>
                                <i class="fas fa-chevron-down" style="font-size:0.75rem;color:#94a3b8;flex-shrink:0;"></i>
                            </div>
                            <div class="custom-select-dropdown">
                                <div style="padding:0.5rem 0.5rem 0;">
                                    <input type="text" class="custom-select-search form-input" placeholder="Search..." style="padding:0.5rem 0.75rem;font-size:0.85rem;">
                                </div>
                                <div class="custom-select-options">
                                    <div class="custom-select-option" data-value="50/50 Double bowl">50/50 Double bowl</div>
                                    <div class="custom-select-option" data-value='Apron Sink - 27"'>Apron Sink - 27"</div>
                                    <div class="custom-select-option" data-value='Apron Sink - 30"'>Apron Sink - 30"</div>
                                    <div class="custom-select-option" data-value='Farm Sink - 36"'>Farm Sink - 36"</div>
                                    <div class="custom-select-option" data-value="Farmhouse Sink">Farmhouse Sink</div>
                                    <div class="custom-select-option" data-value="Single Bowl">Single Bowl</div>
                                    <div class="custom-select-option" data-value='Undermount Sink - 33"'>Undermount Sink - 33"</div>
                                    <div class="custom-select-option" data-value='Undermount Sink - 36"'>Undermount Sink - 36"</div>
                                    <div class="custom-select-option sink-others-opt" data-value="Others">Others</div>
                                </div>
                            </div>
                            <input type="hidden" name="additional_info[sink]" class="custom-select-input">
                        </div>
                        <input type="text" name="additional_info[sink_others_text]" id="sinkOthersText"
                               class="form-input" placeholder="Enter" style="display:none;flex:1;min-width:180px;">
                    </div>
                </div>

                <div class="full-width options-section">
                    <h3>Molding &amp; Door Enhancement</h3>
                    <div class="options-grid">
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][base]"> Base Molding</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][crown]"> Crown Molding on Cabinet</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][decorative_panels]"> Decorative Door Panels</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][glass_door]"> Glass Door</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][light_rail]"> Light Rail Molding</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][scribe_shoe]"> Scribe &amp; Shoe Molding</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][scribe]"> Scribe Molding</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][stacked_crown]"> Stacked Crown</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][wood_hood]"> Wood Hood</label>
                        <div>
                            <label class="check-item"><input type="checkbox" name="additional_info[molding][others]" class="others-checkbox"> Others</label>
                            <input type="text" name="additional_info[molding][others_text]" class="others-textbox form-input" placeholder="Please specify..." style="display:none;margin-top:0.5rem;font-size:0.85rem;">
                        </div>
                    </div>
                </div>

                <div class="full-width options-section">
                    <h3>Storage &amp; Organizer</h3>
                    <div class="options-grid">
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][cutlery]"> Cutlery Insert</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][lazy_susan]"> Lazy Susan</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][pot_pan]"> Pot and Pan Pullout</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][spice]"> Spice Pull Out</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][tray_base]"> Tray Base</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][utensil]"> Utensil Drawer</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][waste_basket]"> Waste Basket</label>
                        <div>
                            <label class="check-item"><input type="checkbox" name="additional_info[storage][others]" class="others-checkbox"> Others</label>
                            <input type="text" name="additional_info[storage][others_text]" class="others-textbox form-input" placeholder="Please specify..." style="display:none;margin-top:0.5rem;font-size:0.85rem;">
                        </div>
                    </div>
                </div>

                <div class="full-width options-section">
                    <h3>Standard Appliances</h3>
                    <div class="options-grid three-col">

                        {{-- Chimney/Hood --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[appliances][chimney_hood]" class="appliance-cb"> Chimney/Hood</label>
                            <div class="appliance-fields" style="display:none;margin-top:0.5rem;">
                                <input type="text" name="additional_info[appliances][chimney_hood_size]" class="form-input mini" placeholder="size">
                            </div>
                        </div>

                        {{-- Cooktop/Range --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[appliances][cooktop_range]" class="appliance-cb"> Cooktop/Range</label>
                            <div class="appliance-fields" style="display:none;margin-top:0.5rem;">
                                <input type="text" name="additional_info[appliances][cooktop_range_size]" class="form-input mini" placeholder="size">
                            </div>
                        </div>

                        {{-- Dishwasher --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[appliances][dishwasher]" class="appliance-cb"> Dishwasher</label>
                            <div class="appliance-fields" style="display:none;margin-top:0.5rem;">
                                <input type="text" name="additional_info[appliances][dishwasher_size]" class="form-input mini" placeholder="size">
                            </div>
                        </div>

                        {{-- Microwave --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[appliances][microwave]" class="appliance-cb"> Microwave</label>
                            <div class="appliance-fields" data-display="flex" style="display:none;margin-top:0.5rem;gap:0.5rem;align-items:center;flex-wrap:wrap;">
                                <select name="additional_info[appliances][microwave_type]" class="form-input" style="flex:1;min-width:140px;">
                                    <option value="">Select</option>
                                    <option>Wall Standalone</option>
                                    <option>Wall Built In</option>
                                    <option>Tall Built In</option>
                                    <option>Over the Range</option>
                                </select>
                                <input type="text" name="additional_info[appliances][microwave_size]" class="form-input mini" placeholder="size">
                            </div>
                        </div>

                        {{-- Oven --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[appliances][oven]" class="appliance-cb"> Oven</label>
                            <div class="appliance-fields" data-display="flex" style="display:none;margin-top:0.5rem;gap:0.5rem;align-items:center;flex-wrap:wrap;">
                                <select name="additional_info[appliances][oven_type]" class="form-input" style="flex:1;min-width:140px;">
                                    <option value="">Select</option>
                                    <option>Base Built In</option>
                                    <option>Tall Built In</option>
                                </select>
                                <input type="text" name="additional_info[appliances][oven_size]" class="form-input mini" placeholder="size">
                            </div>
                        </div>

                        {{-- Refrigerator --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[appliances][refrigerator]" class="appliance-cb"> Refrigerator</label>
                            <div class="appliance-fields" data-display="flex" style="display:none;margin-top:0.5rem;gap:0.5rem;align-items:center;flex-wrap:wrap;">
                                <select name="additional_info[appliances][refrigerator_type]" class="form-input" style="flex:1;min-width:140px;">
                                    <option value="">Select</option>
                                    <option>Standalone</option>
                                    <option>Built In</option>
                                </select>
                                <input type="text" name="additional_info[appliances][refrigerator_size]" class="form-input mini" placeholder="size">
                            </div>
                        </div>

                        {{-- Wine Cooler --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[appliances][wine_cooler]" class="appliance-cb"> Wine Cooler</label>
                            <div class="appliance-fields" style="display:none;margin-top:0.5rem;">
                                <input type="text" name="additional_info[appliances][wine_cooler_size]" class="form-input mini" placeholder="size">
                            </div>
                        </div>

                        {{-- Others --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[appliances][others]" class="others-checkbox"> Others</label>
                            <input type="text" name="additional_info[appliances][others_text]" class="others-textbox form-input" placeholder="Enter" style="display:none;margin-top:0.5rem;font-size:0.85rem;">
                        </div>

                    </div>
                </div>

                <div class="full-width options-section">
                    <h3>Loose Appliances</h3>
                    <div class="options-grid three-col">

                        {{-- Coffee Machine --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[loose][coffee_machine]" class="appliance-cb"> Coffee Machine</label>
                            <div class="appliance-fields" style="display:none;margin-top:0.5rem;">
                                <input type="text" name="additional_info[loose][coffee_machine_size]" class="form-input mini" placeholder="size">
                            </div>
                        </div>

                        {{-- Dryer --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[loose][dryer]" class="appliance-cb"> Dryer</label>
                            <div class="appliance-fields" style="display:none;margin-top:0.5rem;">
                                <input type="text" name="additional_info[loose][dryer_size]" class="form-input mini" placeholder="size">
                            </div>
                        </div>

                        {{-- Freezer --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[loose][freezer]" class="appliance-cb"> Freezer</label>
                            <div class="appliance-fields" style="display:none;margin-top:0.5rem;">
                                <input type="text" name="additional_info[loose][freezer_size]" class="form-input mini" placeholder="size">
                            </div>
                        </div>

                        {{-- Outdoor Grill --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[loose][outdoor_grill]" class="appliance-cb"> Outdoor Grill</label>
                            <div class="appliance-fields" style="display:none;margin-top:0.5rem;">
                                <input type="text" name="additional_info[loose][outdoor_grill_size]" class="form-input mini" placeholder="size">
                            </div>
                        </div>

                        {{-- Warming Drawer --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[loose][warming_drawer]" class="appliance-cb"> Warming Drawer</label>
                            <div class="appliance-fields" style="display:none;margin-top:0.5rem;">
                                <input type="text" name="additional_info[loose][warming_drawer_size]" class="form-input mini" placeholder="size">
                            </div>
                        </div>

                        {{-- Washer --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[loose][washer]" class="appliance-cb"> Washer</label>
                            <div class="appliance-fields" style="display:none;margin-top:0.5rem;">
                                <input type="text" name="additional_info[loose][washer_size]" class="form-input mini" placeholder="size">
                            </div>
                        </div>

                        {{-- Others --}}
                        <div class="appliance-item">
                            <label class="check-item"><input type="checkbox" name="additional_info[loose][others]" class="others-checkbox"> Others</label>
                            <input type="text" name="additional_info[loose][others_text]" class="others-textbox form-input" placeholder="Enter" style="display:none;margin-top:0.5rem;font-size:0.85rem;">
                        </div>

                    </div>
                </div>

                <div class="full-width">
                    <p class="field-info-msg">If you have any non-standard appliances, please <a href="#">click here</a> and submit the detailed measurements.</p>
                </div>

                <div class="form-group-row full-width">
                    <div class="form-group">
                        <label>Multiplier</label>
                        <input type="text" name="additional_info[multiplier]" class="form-input">
                    </div>
                    <div class="form-group">
                        <label>Expected Date <span class="required-star">*</span></label>
                        <input type="date" name="expected_date" value="{{ date('Y-m-d') }}" class="form-input">
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Additional Notes</label>
                    <textarea name="additional_notes" class="form-input rich-editor" rows="6"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="form-footer-actions">
        <a href="{{ route('portal.dashboard') }}" style="text-decoration:none;">
            <button type="button" class="btn btn-outline">BACK</button>
        </a>
        <div class="right-actions">
            <button type="button" class="btn btn-save">SAVE AS DRAFT</button>
            <button type="submit" class="btn btn-submit">SUBMIT</button>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    // ── Section collapse/expand ─────────────────────────────────────
    const toggleSection = (body, toggle, section, open) => {
        if (open) {
            body.style.display = 'block';
            toggle.innerHTML = '<i class="fas fa-minus"></i>';
            section.classList.add('active');
            section.classList.remove('collapsed');
        } else {
            body.style.display = 'none';
            toggle.innerHTML = '<i class="fas fa-plus"></i>';
            section.classList.remove('active');
            section.classList.add('collapsed');
        }
    };

    const reqBody    = document.getElementById('requiredInfoBody');
    const reqToggle  = document.getElementById('requiredInfoToggle');
    const reqSection = document.getElementById('requiredInfoSection');
    const addBody    = document.getElementById('additionalInfoBody');
    const addToggle  = document.getElementById('additionalInfoToggle');
    const addSection = document.getElementById('additionalInfoSection');

    document.getElementById('requiredInfoHeader').addEventListener('click', () => {
        toggleSection(reqBody, reqToggle, reqSection, reqBody.style.display === 'none');
    });
    document.getElementById('additionalInfoHeader').addEventListener('click', () => {
        toggleSection(addBody, addToggle, addSection, addBody.style.display === 'none');
    });

    // ── Searchable custom select ────────────────────────────────────
    document.querySelectorAll('.custom-select-wrapper').forEach(wrapper => {
        const trigger  = wrapper.querySelector('.custom-select-trigger');
        const dropdown = wrapper.querySelector('.custom-select-dropdown');
        const search   = wrapper.querySelector('.custom-select-search');
        const options  = wrapper.querySelectorAll('.custom-select-option');
        const label    = wrapper.querySelector('.custom-select-label');
        const hidden   = wrapper.querySelector('.custom-select-input');

        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            // Close other open dropdowns
            document.querySelectorAll('.custom-select-dropdown').forEach(d => {
                if (d !== dropdown) d.style.display = 'none';
            });
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            if (dropdown.style.display === 'block' && search) search.focus();
        });

        if (search) {
            search.addEventListener('input', () => {
                const q = search.value.toLowerCase();
                options.forEach(opt => {
                    opt.style.display = opt.textContent.toLowerCase().includes(q) ? 'block' : 'none';
                });
            });
            // Prevent dropdown close when clicking search
            search.addEventListener('click', e => e.stopPropagation());
        }

        options.forEach(opt => {
            opt.addEventListener('click', () => {
                label.textContent = opt.textContent;
                hidden.value = opt.dataset.value;
                dropdown.style.display = 'none';
                if (search) search.value = '';
                options.forEach(o => o.style.display = 'block');

                // Sink "Others" text input
                if (opt.classList.contains('sink-others-opt')) {
                    const sinkOthers = document.getElementById('sinkOthersText');
                    if (sinkOthers) {
                        sinkOthers.style.display = 'block';
                        sinkOthers.focus();
                    }
                } else if (wrapper.querySelector('.sink-others-opt')) {
                    const sinkOthers = document.getElementById('sinkOthersText');
                    if (sinkOthers) { sinkOthers.style.display = 'none'; sinkOthers.value = ''; }
                }
            });
        });
    });

    // Close dropdowns on outside click
    document.addEventListener('click', () => {
        document.querySelectorAll('.custom-select-dropdown').forEach(d => d.style.display = 'none');
    });

    // ── Second Door checkbox → text input ──────────────────────────
    document.getElementById('secondDoor').addEventListener('change', function () {
        const field = document.getElementById('secondDoorText');
        field.style.display = this.checked ? 'block' : 'none';
        if (!this.checked) field.value = '';
        else field.focus();
    });

    // ── Soffits checkbox → Width/Height inputs ──────────────────────
    document.getElementById('soffits').addEventListener('change', function () {
        document.getElementById('soffitsFields').style.display = this.checked ? 'block' : 'none';
    });

    // ── Appliance checkboxes → conditional size / type fields ──────
    document.querySelectorAll('.appliance-cb').forEach(cb => {
        cb.addEventListener('change', function () {
            const fields = this.closest('.appliance-item').querySelector('.appliance-fields');
            if (!fields) return;
            const show = this.checked;
            fields.style.display = show ? (fields.dataset.display || 'block') : 'none';
            if (!show) fields.querySelectorAll('input, select').forEach(el => el.value = '');
        });
    });

    // ── "Others" checkboxes in option grids ────────────────────────
    document.querySelectorAll('.others-checkbox').forEach(cb => {
        cb.addEventListener('change', function () {
            const textbox = this.closest('div').querySelector('.others-textbox');
            if (!textbox) return;
            textbox.style.display = this.checked ? 'block' : 'none';
            if (this.checked) textbox.focus();
            else textbox.value = '';
        });
    });

    // ── File upload (accumulating) ──────────────────────────────────
    const uploadArea = document.getElementById('uploadArea');
    const fileInput  = document.getElementById('fileInput');
    const fileList   = document.getElementById('fileList');
    const theForm    = document.querySelector('.submit-request-container');
    let accFiles = [];

    function iconFor(name) {
        const ext = name.split('.').pop().toLowerCase();
        if (['pdf'].includes(ext))                            return 'fa-file-pdf';
        if (['xls','xlsx','csv','tsv'].includes(ext))         return 'fa-file-excel';
        if (['doc','docx','txt'].includes(ext))               return 'fa-file-word';
        if (['ppt','pptx'].includes(ext))                     return 'fa-file-powerpoint';
        if (['jpg','jpeg','png','webp','heic'].includes(ext))  return 'fa-file-image';
        return 'fa-file';
    }

    function renderFiles() {
        if (accFiles.length === 0) { fileList.innerHTML = ''; return; }
        fileList.innerHTML = accFiles.map((f, i) => `
            <div style="display:flex;align-items:center;gap:0.5rem;margin-top:0.4rem;font-size:0.82rem;color:var(--secondary-color);">
                <i class="fas ${iconFor(f.name)}" style="color:var(--primary-color);"></i>
                <span style="flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${f.name}</span>
                <span style="color:#94a3b8;font-size:0.75rem;">${(f.size/1024).toFixed(0)} KB</span>
                <button type="button" data-idx="${i}" class="rm-file"
                    style="background:none;border:none;color:#ef4444;cursor:pointer;font-size:0.9rem;padding:0 0.25rem;" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>`).join('');

        fileList.querySelectorAll('.rm-file').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                accFiles.splice(parseInt(this.dataset.idx), 1);
                renderFiles();
            });
        });
    }

    const MAX_TOTAL_MB  = 100;
    const MAX_SINGLE_MB = 10;

    function totalSizeMB() {
        return accFiles.reduce((sum, f) => sum + f.size, 0) / (1024 * 1024);
    }

    function showUploadError(msg) {
        let el = document.getElementById('uploadSizeError');
        if (!el) {
            el = document.createElement('p');
            el.id = 'uploadSizeError';
            el.style.cssText = 'color:#ef4444;font-size:0.82rem;margin-top:0.4rem;';
            uploadArea.parentNode.insertBefore(el, uploadArea.nextSibling);
        }
        el.textContent = msg;
    }

    function clearUploadError() {
        const el = document.getElementById('uploadSizeError');
        if (el) el.textContent = '';
    }

    function addFiles(newFiles) {
        const skipped = [];
        Array.from(newFiles).forEach(f => {
            if (f.size > MAX_SINGLE_MB * 1024 * 1024) {
                skipped.push(`${f.name} (exceeds ${MAX_SINGLE_MB} MB limit)`);
                return;
            }
            if (!accFiles.some(a => a.name === f.name && a.size === f.size)) accFiles.push(f);
        });
        if (skipped.length) {
            showUploadError('Skipped: ' + skipped.join(', '));
        } else {
            clearUploadError();
        }
        renderFiles();
    }

    uploadArea.addEventListener('click', (e) => {
        if (!e.target.closest('.rm-file')) fileInput.click();
    });

    fileInput.addEventListener('change', () => {
        addFiles(fileInput.files);
        // Reset picker so the same file can be re-selected after removal
        fileInput.value = '';
    });

    // Sync accumulated files into the input just before the form submits
    theForm.addEventListener('submit', (e) => {
        if (totalSizeMB() > MAX_TOTAL_MB) {
            e.preventDefault();
            showUploadError(`Total upload size (${totalSizeMB().toFixed(1)} MB) exceeds the ${MAX_TOTAL_MB} MB limit. Please remove some files.`);
            uploadArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }
        clearUploadError();
        const dt = new DataTransfer();
        accFiles.forEach(f => dt.items.add(f));
        fileInput.files = dt.files;
    });

    // Drag-and-drop
    uploadArea.addEventListener('dragover', e => { e.preventDefault(); uploadArea.style.borderColor = 'var(--primary-color)'; });
    uploadArea.addEventListener('dragleave', () => { uploadArea.style.borderColor = ''; });
    uploadArea.addEventListener('drop', e => {
        e.preventDefault();
        uploadArea.style.borderColor = '';
        addFiles(e.dataTransfer.files);
    });
});
</script>
@endsection
