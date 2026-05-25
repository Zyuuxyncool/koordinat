@if(($dokumen_siswa->flag ?? 0) != 1)
    <div class="row">
        <div class="col-lg-4">
            <x-io-input name="tanggal_dokumen" class="form-control-sm datepicker" caption="Tanggal Terbit" :value="format_date($dokumen_siswa->tanggal_dokumen ?? '')" :viewtype="2" />
            <x-io-textarea name="alamat" caption="Alamat" :value="$dokumen_siswa->alamat_siswa->alamat ?? ''" rows="2" class="form-control-sm" :viewtype="2" />
            <div class="row">
                <div class="col-lg-6">
                    <x-io-select name="provinsi_id" caption="Provinsi" data-dropdown-parent="#modal_info" class="form-select-sm" :viewtype="2" />
                </div>
                <div class="col-lg-6">
                    <x-io-select name="kabupaten_id" caption="Kabupaten / Kota" data-dropdown-parent="#modal_info" class="form-select-sm" :viewtype="2" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <x-io-select name="kecamatan_id" caption="Kecamatan" data-dropdown-parent="#modal_info" class="form-control-sm" :viewtype="2" />
                </div>
                <div class="col-lg-6">
                    <x-io-select name="kelurahan_id" caption="Desa / Kelurahan" data-dropdown-parent="#modal_info" class="form-control-sm" :viewtype="2" />
                </div>
            </div>

            <label class="col-form-label py-1 required fw-bold fs-6">Foto Depan Rumah Disertai Label Koordinat dan Alamat</label>
            <div class="border rounded-3 p-3 bg-light">
                <video id="kk_camera_preview" class="w-100 rounded-2 mb-3 d-none" autoplay playsinline muted style="max-height: 320px; object-fit: cover;"></video>
                <canvas id="kk_camera_canvas" class="d-none"></canvas>
                <img id="kk_camera_snapshot" class="w-100 rounded-2 mb-3 {{ empty($dokumen_siswa->alamat_siswa->foto ?? '') ? 'd-none' : '' }}" src="{{ !empty($dokumen_siswa->alamat_siswa->foto ?? '') ? asset('storage/' . $dokumen_siswa->alamat_siswa->foto) : '' }}" alt="Foto rumah">
                <input type="file" name="file_foto" id="file_foto" class="form-control form-control-sm d-none" accept="image/*" {{ empty($dokumen_siswa->alamat_siswa->foto) ? 'required' : '' }}>
                <div class="d-flex gap-2 flex-wrap">
                    <button type="button" class="btn btn-sm btn-primary" id="kk_camera_start">Buka Kamera</button>
                    <button type="button" class="btn btn-sm btn-success d-none" id="kk_camera_take">Ambil Foto</button>
                    <button type="button" class="btn btn-sm btn-secondary d-none" id="kk_camera_reset">Ulangi</button>
                </div>
                <small class="text-muted d-block mt-2">Setelah foto diambil, lokasi saat ini akan diisi otomatis ke Latitude dan Longitude.</small>
            </div>

            @if(!empty($dokumen_siswa))
                <p>Status :<br><b>{{ $dokumen_siswa->status }}</b></p>
                <p>Catatan Koreksi :<br><b>{{ $dokumen_siswa->verified_comment ?? '-' }}</b></p>
            @endif
        </div>
        <div class="col-lg-8">
            <label class="col-form-label py-1 required fw-bold fs-6">File Kartu Keluarga</label>
            <x-input type="file" name="file_dokumen" :value="$dokumen_siswa->details[0]->file ?? ''" class="form-control-sm" />
            <div class="mt-6" id="kk_lama" style="display: none;">
                <label class="col-form-label py-1 required fw-bold fs-6">File Kartu Keluarga Lama / Dokumen Kelengkapan Kartu Keluarga</label>
                <x-input type="file" name="file_dokumen_2" :value="$dokumen_siswa->details[1]->file ?? ''" class="form-control-sm" />
            </div>
            <div class="row">
                <label class="col-lg-3 col-form-label fw-bold fs-6"></label>
                <div class="col-lg-12" style="position: relative;">
                    <p class="mb-0 mt-3">Geser icon warna merah, sesuai pada koordinat rumah kamu</p>
                    <div id="map_kk" style="height: 500px;width: 100%;"></div>
                    <a target="_blank" href="https://www.google.com/maps?layer=c&cbll=-7.545111530211729,112.25441176979812" id="button_streetview_kk" class="btn btn-primary" style="position: absolute; top: 50px; right: 20px;">Lihat Street View Titik Koordinat</a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-6">
                    <x-io-input prefix="kk_" name="latitude"  caption="Latitude"  :value="$dokumen_siswa->alamat_siswa->latitude ?? ''"  :viewtype="2" />
                    <small class="text-muted">
                        Contoh: <b>-7.447</b> (nilai biasanya sekitar -7.xxxxx)
                    </small>
                </div>
                <div class="col-lg-6">
                    <x-io-input prefix="kk_" name="longitude"  caption="Longitude" :value="$dokumen_siswa->alamat_siswa->longitude ?? ''"  :viewtype="2" />
                    <small class="text-muted">
                        Contoh: <b>112.718</b> (nilai biasanya sekitar 112.xxxxx)
                    </small>
                </div>
            </div>

        </div>
    </div>
@endif

@if(($dokumen_siswa->flag ?? 0) == 1)
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <p>Tanggal Terbit :<br><b>{{ format_date($dokumen_siswa->tanggal_dokumen ?? '') }}</b></p>
            <p>Alamat :<br><b>{{ $dokumen_siswa->alamat_siswa->alamat ?? '' }}<br>{{ $dokumen_siswa->alamat_siswa->lokasi_lengkap }}</b></p>
            <p>Status :<br><b>{{ $dokumen_siswa->status }}</b></p>
        </div>
        <div class="col-lg-8">
            <div class="w-100 pb-4">
                <x-file-preview :file="$dokumen_siswa->details[0]->file ?? ''" />
                <div class="row mt-6">
                    <div class="col-lg-4">
                        <p class="mb-2">Foto Lokasi</p>
                        <x-file-preview :file="$dokumen_siswa->alamat_siswa->foto ?? ''" />
                        Koordinat : <br><b>{{ $dokumen_siswa->alamat_siswa->latitude ?? '' }}, {{ $dokumen_siswa->alamat_siswa->longitude ?? '' }}</b>
                    </div>
                    <div class="col-lg-8">
                        <div id="map_kk" style="height: 500px;width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<script>
    $tanggal_dokumen = $('#tanggal_dokumen');
    $tanggal_dokumen.change(() => {
        let $kk_lama = $('#kk_lama');
        let tanggal_dokumen = $tanggal_dokumen.val();
        let tanggal_minimal = '{{ date('Y-m-d', strtotime('-1 years ' . session('cut_off_juknis'))) }}'
        if (format_date(tanggal_dokumen) > tanggal_minimal) $kk_lama.show();
        else $kk_lama.hide();
    });
    $tanggal_dokumen.change();

    selected_provinsi_id = '{{ $dokumen_siswa->alamat_siswa->provinsi_id ?? '' }}';
    selected_kabupaten_id = '{{ $dokumen_siswa->alamat_siswa->kabupaten_id ?? '' }}';
    selected_kecamatan_id = '{{ $dokumen_siswa->alamat_siswa->kecamatan_id ?? '' }}';
    selected_kelurahan_id = '{{ $dokumen_siswa->alamat_siswa->kelurahan_id ?? '' }}';
    $provinsi_id = $('#provinsi_id');
    $kabupaten_id = $('#kabupaten_id');
    $kecamatan_id = $('#kecamatan_id');
    $kelurahan_id = $('#kelurahan_id');

    get_location($provinsi_id, 1, '', selected_provinsi_id);
    $provinsi_id.change(() => {
        let id = $provinsi_id.find('option:selected').val();
        get_location($kabupaten_id, 2, id, selected_kabupaten_id);
    });
    $kabupaten_id.change(() => {
        let id = $kabupaten_id.find('option:selected').val();
        get_location($kecamatan_id, 3, id, selected_kecamatan_id);
    });
    $kecamatan_id.change(() => {
        let id = $kecamatan_id.find('option:selected').val();
        get_location($kelurahan_id, 4, id, selected_kelurahan_id);
    });
    
    $('#map_kk').html('');
    let lng = {{ str_replace(' ', '', data_get($dokumen_siswa, 'alamat_siswa.longitude', '112.632632')) }};
    let lat = {{ str_replace(' ', '', data_get($dokumen_siswa, 'alamat_siswa.latitude', '-7.966620')) }};

    // Inisialisasi OpenLayers dengan Google Maps Ultra HD Hybrid
    map_kk = new ol.Map({
        target: 'map_kk',
        layers: [
            new ol.layer.Tile({
                source: new ol.source.XYZ({
                    // Menggunakan tipe server lyrs=s,h untuk memaksa render aset Satelit kualitas tertinggi + teks jalan
                    url: 'https://mt0.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',
                    maxZoom: 22,
                    crossOrigin: 'anonymous'
                })
            })
        ],
        renderer: 'webgl',
        view: new ol.View({
            center: ol.proj.fromLonLat([lng, lat]),
            zoom: 19, // Tingkat perbesaran default 19 agar langsung fokus tajam ke atap rumah siswa
            maxZoom: 22
        }),
    });

    let defaultLng = {{ str_replace(' ', '', data_get($dokumen_siswa, 'alamat_siswa.longitude', '112.632632')) }};
    let defaultLat = {{ str_replace(' ', '', data_get($dokumen_siswa, 'alamat_siswa.latitude', '-7.966620')) }};

    // Create the marker feature
    let markerFeatureKK = new ol.Feature({
        geometry: new ol.geom.Point(
            ol.proj.fromLonLat([defaultLng, defaultLat])
        ),
        name: 'Titik Koordinat',
    });

    let markerLayerKK = new ol.layer.Vector({
        source: new ol.source.Vector({
            features: [markerFeatureKK],
        }),
        style: new ol.style.Style({
            image: new ol.style.Icon({
                anchor: [0.5, 1],
                anchorXUnits: 'fraction',
                anchorYUnits: 'fraction',
                src: '{{ asset('images/marker.png') }}',
                scale: 0.5
            }),
        }),
    });
    map_kk.addLayer(markerLayerKK);

    @if(($siswa->is_lock ?? 0) == 0)
    let translateKK = new ol.interaction.Translate({
        features: new ol.Collection([markerFeatureKK])
    });
    map_kk.addInteraction(translateKK);

    // Listen for drag end to get updated coordinates
    translateKK.on('translateend', function (e) {
        let coords = e.features.item(0).getGeometry().getCoordinates();
        let lonLat = ol.proj.toLonLat(coords);
        $('#kk_latitude').val(lonLat[1]);
        $('#kk_longitude').val(lonLat[0]);
        $('#button_streetview_kk').attr('href', 'https://www.google.com/maps?layer=c&cbll=' + lonLat[1] + ',' + lonLat[0]);
    });
    @endif

    function updateMarkerLocation(lat, lng) {
        if (lat === '' || lat === null) return;
        if (lng === '' || lng === null) return;

        const newCoords = ol.proj.fromLonLat([lng, lat]);
        markerFeatureKK.getGeometry().setCoordinates(newCoords);
        map_kk.getView().setCenter(newCoords);
    }

    // BONUS: Otomatis memindahkan titik peta jika input teks latitude/longitude diketik manual oleh admin/siswa
    $('#kk_latitude, #kk_longitude').on('input change', function() {
        let inputLat = parseFloat($('#kk_latitude').val());
        let inputLng = parseFloat($('#kk_longitude').val());
        
        if (!isNaN(inputLat) && !isNaN(inputLng)) {
            let newCoords = ol.proj.fromLonLat([inputLng, inputLat]);
            markerFeatureKK.getGeometry().setCoordinates(newCoords);
            map_kk.getView().animate({
                center: newCoords,
                duration: 400,
                zoom: 19
            });
            $('#button_streetview_kk').attr('href', 'https://www.google.com/maps?layer=c&cbll=' + inputLat + ',' + inputLng);
        }
    });

    function updateKkCoordinates(lat, lng) {
        $('#kk_latitude').val(lat);
        $('#kk_longitude').val(lng);
        $('#kk_latitude').trigger('input');
    }

    function captureCurrentKkLocation() {
        if (!navigator.geolocation) return;

        navigator.geolocation.getCurrentPosition(function(position) {
            updateKkCoordinates(position.coords.latitude.toFixed(6), position.coords.longitude.toFixed(6));
        });
    }

    let kkCameraStream = null;
    const kkCameraPreview = document.getElementById('kk_camera_preview');
    const kkCameraCanvas = document.getElementById('kk_camera_canvas');
    const kkCameraSnapshot = document.getElementById('kk_camera_snapshot');
    const kkFileFoto = document.getElementById('file_foto');

    async function startKkCamera() {
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) return;

        kkCameraStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' }, audio: false });
        kkCameraPreview.srcObject = kkCameraStream;
        kkCameraPreview.classList.remove('d-none');
        $('#kk_camera_take').removeClass('d-none');
        $('#kk_camera_reset').removeClass('d-none');
    }

    function stopKkCamera() {
        if (kkCameraStream) {
            kkCameraStream.getTracks().forEach(track => track.stop());
            kkCameraStream = null;
        }
        kkCameraPreview.srcObject = null;
        kkCameraPreview.classList.add('d-none');
        $('#kk_camera_take').addClass('d-none');
    }

    function blobToFile(blob, fileName) {
        return new File([blob], fileName, { type: blob.type, lastModified: Date.now() });
    }

    function setFileInputFromBlob(blob) {
        const file = blobToFile(blob, 'kk-foto.jpg');
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        kkFileFoto.files = dataTransfer.files;
    }

    function takeKkPhoto() {
        const width = kkCameraPreview.videoWidth;
        const height = kkCameraPreview.videoHeight;

        if (!width || !height) return;

        kkCameraCanvas.width = width;
        kkCameraCanvas.height = height;
        const context = kkCameraCanvas.getContext('2d');
        context.drawImage(kkCameraPreview, 0, 0, width, height);

        kkCameraCanvas.toBlob(function(blob) {
            if (!blob) return;

            setFileInputFromBlob(blob);
            kkCameraSnapshot.src = URL.createObjectURL(blob);
            kkCameraSnapshot.classList.remove('d-none');
            stopKkCamera();
            captureCurrentKkLocation();
        }, 'image/jpeg', 0.92);
    }

    $('#kk_camera_start').on('click', function() {
        startKkCamera().catch(function() {
            alert('Kamera tidak dapat dibuka. Pastikan izin kamera sudah diberikan.');
        });
    });

    $('#kk_camera_take').on('click', function() {
        takeKkPhoto();
    });

    $('#kk_camera_reset').on('click', function() {
        stopKkCamera();
        kkFileFoto.value = '';
        kkCameraSnapshot.classList.add('d-none');
    });

    if (!$('#kk_latitude').val() || !$('#kk_longitude').val()) {
        captureCurrentKkLocation();
    }

    init_form_element();
</script>
