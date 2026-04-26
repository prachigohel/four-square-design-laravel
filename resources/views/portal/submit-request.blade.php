@extends('layouts.portal')

@section('title', 'Submit New Request - Kitchen365 Portal')

@section('content')
<div class="submit-request-container">
    <div class="form-section active" id="requiredInfoSection">
        <div class="section-header" id="requiredInfoHeader">
            <div class="section-title-group">
                <div class="status-icon success-icon"><i class="fas fa-check-circle"></i></div>
                <div>
                    <h2 class="section-title">Required Information</h2>
                    <p class="section-subtitle">Request Type, Cabinet brand, Door style, Ceiling height, Digital assets</p>
                </div>
            </div>
            <button class="toggle-section-btn" id="requiredInfoToggle"><i class="fas fa-minus"></i></button>
        </div>
        
        <div class="section-body" id="requiredInfoBody">
            <div class="form-grid">
                <div class="form-group full-width">
                    <label>Request Title <span class="required-star">*</span></label>
                    <input type="text" placeholder="Enter request title" class="form-input">
                </div>
                
                <div class="form-group">
                    <label>Select Request Type <span class="required-star">*</span></label>
                    <select class="form-input">
                        <option>Select</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Cabinet Brand <span class="required-star">*</span></label>
                    <select class="form-input">
                        <option>Select</option>
                    </select>
                </div>

                <div class="form-group-row">
                    <div class="form-group">
                        <label>Ceiling Height</label>
                        <div class="input-with-label">
                            <input type="text" placeholder="Size" class="form-input small">
                            <span>inches</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Wall Cabinet Height</label>
                        <div class="input-with-label">
                            <input type="text" placeholder="Size" class="form-input small">
                            <span>inches</span>
                        </div>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Measurements <span class="required-star">*</span></label>
                    <p class="field-info">Accepted file types are jpg, jpeg, png, webp, heic, pdf, xls, xlsx, csv, tsv, ppt, pptx, doc, docx, .KIT and dsg file</p>
                    <div class="file-upload-area">
                        <div class="upload-plus">+</div>
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
                        <input type="checkbox" id="secondDoor">
                        <label for="secondDoor">Second Door Style and Finish</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="soffits">
                        <label for="soffits">Soffits</label>
                    </div>
                </div>

                <div class="form-group-row full-width">
                    <div class="form-group">
                        <label>Door Finish</label>
                        <div class="multi-input">
                            <div class="input-unit"><span>Wall:</span> <input type="text" class="form-input mini"></div>
                            <div class="input-unit"><span>Base:</span> <input type="text" class="form-input mini"></div>
                            <div class="input-unit"><span>Island:</span> <input type="text" class="form-input mini"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Decoration</label>
                        <select class="form-input">
                            <option>Select</option>
                        </select>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Sink</label>
                    <select class="form-input small-half">
                        <option>Select</option>
                    </select>
                </div>

                <div class="full-width options-section">
                    <h3>Molding & Door Enhancement</h3>
                    <div class="options-grid">
                        <label class="check-item"><input type="checkbox"> Base Molding</label>
                        <label class="check-item"><input type="checkbox"> Crown Molding on Cabinet</label>
                        <label class="check-item"><input type="checkbox"> Decorative Door Panels</label>
                        <label class="check-item"><input type="checkbox"> Glass Door</label>
                        <label class="check-item"><input type="checkbox"> Light Rail Molding</label>
                        <label class="check-item"><input type="checkbox"> Scribe & Shoe Molding</label>
                        <label class="check-item"><input type="checkbox"> Scribe Molding</label>
                        <label class="check-item"><input type="checkbox"> Stacked Crown</label>
                        <label class="check-item"><input type="checkbox"> Wood Hood</label>
                        <label class="check-item"><input type="checkbox"> Others</label>
                    </div>
                </div>

                <div class="full-width options-section">
                    <h3>Storage & Organizer</h3>
                    <div class="options-grid">
                        <label class="check-item"><input type="checkbox"> Cutlery Insert</label>
                        <label class="check-item"><input type="checkbox"> Lazy Susan</label>
                        <label class="check-item"><input type="checkbox"> Pot and Pan Pullout</label>
                        <label class="check-item"><input type="checkbox"> Spice Pullout</label>
                        <label class="check-item"><input type="checkbox"> Tray Base</label>
                        <label class="check-item"><input type="checkbox"> Utensil Drawer</label>
                        <label class="check-item"><input type="checkbox"> Waste Basket</label>
                        <label class="check-item"><input type="checkbox"> Others</label>
                    </div>
                </div>

                <div class="full-width options-section">
                    <h3>Standard Appliances</h3>
                    <div class="options-grid three-col">
                        <label class="check-item"><input type="checkbox"> Chimney/Hood</label>
                        <label class="check-item"><input type="checkbox"> Cooktop/Range</label>
                        <label class="check-item"><input type="checkbox"> Dishwasher</label>
                        <label class="check-item"><input type="checkbox"> Microwave</label>
                        <label class="check-item"><input type="checkbox"> Oven</label>
                        <label class="check-item"><input type="checkbox"> Refrigerator</label>
                        <label class="check-item"><input type="checkbox"> Wine Cooler</label>
                        <label class="check-item"><input type="checkbox"> Others</label>
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
                        <input type="date" value="2026-04-20" class="form-input">
                    </div>
                </div>

                <div class="form-group full-width">
                    <label>Additional Notes</label>
                    <textarea class="form-input rich-editor" rows="6"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="form-footer-actions">
        <a href="{{ route('portal.dashboard') }}" style="text-decoration: none;">
            <button class="btn btn-outline">BACK</button>
        </a>
        <div class="right-actions">
            <button class="btn btn-save">SAVE AS DRAFT</button>
            <button class="btn btn-submit">SUBMIT</button>
        </div>
    </div>
</div>

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
    });
</script>
@endsection
