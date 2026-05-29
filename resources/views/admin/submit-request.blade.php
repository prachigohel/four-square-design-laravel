@extends('layouts.portal')

@section('title', 'Submit New Request - Four Square Design Portal')

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
                <div class="form-group full-width">
                    <label>Request Title <span class="required-star">*</span></label>
                    <input type="text" name="title" placeholder="Enter request title" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label>Select Request Type <span class="required-star">*</span></label>
                    <select name="request_type" class="form-input">
                        <option value="">Select</option>
                        <option value="Kitchen Design">Kitchen Design</option>
                        <option value="Bath Design">Bath Design</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Cabinet Brand <span class="required-star">*</span></label>
                    <select name="cabinet_brand" class="form-input">
                        <option value="">Select</option>
                        <option value="Brand A">Brand A</option>
                        <option value="Brand B">Brand B</option>
                    </select>
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
                    <p class="field-info">Accepted file types are jpg, jpeg, png, webp, heic, pdf, xls, xlsx, csv, tsv, ppt, pptx, doc, docx, .KIT and dsg file</p>
                    <div class="file-upload-area" id="uploadArea" style="cursor: pointer; position: relative;">
                        <input type="file" name="attachments[]" id="fileInput" multiple style="display: none;">
                        <div class="upload-plus">+</div>
                        <div id="fileList" style="margin-top: 1rem; font-size: 0.8rem; color: var(--primary-color);"></div>
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
                    <p class="section-subtitle">Appliances, Molding & Door, Notes, Storage</p>
                </div>
            </div>
            <button class="toggle-section-btn" id="additionalInfoToggle"><i class="fas fa-plus"></i></button>
        </div>

        <div class="section-body" id="additionalInfoBody" style="display: none;">
            <div class="form-grid">
                <div class="checkbox-row">
                    <div class="checkbox-group">
                        <input type="checkbox" name="additional_info[second_door]" id="secondDoor">
                        <label for="secondDoor">Second Door Style and Finish</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="additional_info[soffits]" id="soffits">
                        <label for="soffits">Soffits</label>
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
                            <option value="Standard">Standard</option>
                            <option value="Premium">Premium</option>
                        </select>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Sink</label>
                    <select name="additional_info[sink]" class="form-input small-half">
                        <option value="">Select</option>
                        <option value="Undermount">Undermount</option>
                        <option value="Farmhouse">Farmhouse</option>
                    </select>
                </div>

                <div class="full-width options-section">
                    <h3>Molding & Door Enhancement</h3>
                    <div class="options-grid">
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][base]"> Base Molding</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][crown]"> Crown Molding on Cabinet</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][decorative_panels]"> Decorative Door Panels</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][glass_door]"> Glass Door</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][light_rail]"> Light Rail Molding</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][scribe_shoe]"> Scribe & Shoe Molding</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][scribe]"> Scribe Molding</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][stacked_crown]"> Stacked Crown</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][wood_hood]"> Wood Hood</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[molding][others]"> Others</label>
                    </div>
                </div>

                <div class="full-width options-section">
                    <h3>Storage & Organizer</h3>
                    <div class="options-grid">
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][cutlery]"> Cutlery Insert</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][lazy_susan]"> Lazy Susan</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][pot_pan]"> Pot and Pan Pullout</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][spice]"> Spice Pullout</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][tray_base]"> Tray Base</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][utensil]"> Utensil Drawer</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][waste_basket]"> Waste Basket</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[storage][others]"> Others</label>
                    </div>
                </div>

                <div class="full-width options-section">
                    <h3>Standard Appliances</h3>
                    <div class="options-grid three-col">
                        <label class="check-item"><input type="checkbox" name="additional_info[appliances][chimney_hood]"> Chimney/Hood</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[appliances][cooktop_range]"> Cooktop/Range</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[appliances][dishwasher]"> Dishwasher</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[appliances][microwave]"> Microwave</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[appliances][oven]"> Oven</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[appliances][refrigerator]"> Refrigerator</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[appliances][wine_cooler]"> Wine Cooler</label>
                        <label class="check-item"><input type="checkbox" name="additional_info[appliances][others]"> Others</label>
                    </div>
                </div>

                <div class="full-width options-section">
                    <h3>Loose Appliances</h3>
                    <div class="options-grid three-col">
                        <label class="check-item"><input type="checkbox"> Coffee Machine</label>
                        <label class="check-item"><input type="checkbox"> Dryer</label>
                        <label class="check-item"><input type="checkbox"> Freezer</label>
                        <label class="check-item"><input type="checkbox"> Outdoor Grill</label>
                        <label class="check-item"><input type="checkbox"> Warming Drawer</label>
                        <label class="check-item"><input type="checkbox"> Washer</label>
                        <label class="check-item"><input type="checkbox"> Others</label>
                    </div>
                </div>

                <div class="full-width">
                    <p class="field-info-msg">If you have any non-standard appliances, please <a href="#">click here</a> and submit the detailed measurements.</p>
                </div>

                <div class="form-group-row full-width">
                    <div class="form-group">
                        <label>Multiplier</label>
                        <input type="text" class="form-input">
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
        <a href="{{ route('portal.dashboard') }}" style="text-decoration: none;">
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
        const reqToggle = document.getElementById('requiredInfoToggle');
        const addToggle = document.getElementById('additionalInfoToggle');
        const reqBody = document.getElementById('requiredInfoBody');
        const addBody = document.getElementById('additionalInfoBody');
        const reqSection = document.getElementById('requiredInfoSection');
        const addSection = document.getElementById('additionalInfoSection');

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

        document.getElementById('requiredInfoHeader').addEventListener('click', () => {
            const isOpen = reqBody.style.display !== 'none';
            toggleSection(reqBody, reqToggle, reqSection, !isOpen);
        });

        document.getElementById('additionalInfoHeader').addEventListener('click', () => {
            const isOpen = addBody.style.display !== 'none';
            toggleSection(addBody, addToggle, addSection, !isOpen);
        });

        // File upload trigger
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');
        const fileList = document.getElementById('fileList');

        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                fileList.innerHTML = Array.from(fileInput.files).map(f => `<div><i class="fas fa-file"></i> ${f.name}</div>`).join('');
            }
        });
    });
</script>
@endsection
