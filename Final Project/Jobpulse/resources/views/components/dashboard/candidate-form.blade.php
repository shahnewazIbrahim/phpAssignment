<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Candidate Profile</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="d-flex justify-content-center align-items-center">
                                
                                <div class="d-flex justify-content-center align-items-center rounded-circle bg-danger overflow-hidden" id="preview">
    
                                </div>
                            </div>
                            <div class="col-md-12 p-2">
                                <label>Image</label>
                                <input type="file" class="form-control" id="image">

                            </div>
                            <div class="col-md-12 p-2">
                                <label>Address</label>
                                <textarea id="address" placeholder="User Adress" class="form-control"></textarea>
                            </div>

                            <div class="col-md-12 p-2">
                                <label>SSC</label>
                                <textarea id="ssc" placeholder="SSC" class="form-control"></textarea>
                            </div>

                            <div class="col-md-12 p-2">
                                <label>HSC</label>
                                <textarea id="hsc" placeholder="HSC" class="form-control"></textarea>
                            </div>

                            <div class="col-md-12 p-2">
                                <label>Graduation</label>
                                <textarea id="hons" placeholder="Hons" class="form-control"></textarea>
                            </div>

                            <div class="col-md-12 p-2">
                                <label>Other Qualification</label>
                                <textarea id="otherQualification" placeholder="Mobile" class="form-control" type="mobile"></textarea>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onUpdate()" class="btn mt-3 w-100  bg-gradient-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

CKEDITOR.replace( 'ssc');
CKEDITOR.replace( 'hsc');
CKEDITOR.replace( 'hons');
CKEDITOR.replace( 'otherQualification');
    getProfile();

let sscEditor = CKEDITOR.instances['ssc'];
let hscEditor = CKEDITOR.instances['hsc'];
let honsEditor = CKEDITOR.instances['hons'];
let otherQualificationEditor = CKEDITOR.instances['otherQualification'];
    async function getProfile(){
        try{
            showLoader();
            let res=await axios.get("/api/candidate-profile",HeaderToken());
            hideLoader();

            if (res.data['candidate']['image']) {
                document.getElementById('preview').innerHTML=`
                    <img src="${window.location.origin}/${res.data['candidate']['image']}" style="max-width: 100px;"/>
                `;
            }
            document.getElementById('address').value=res.data['candidate']['address'] ?? "";
            document.getElementById('ssc').value= sscEditor.setData(res.data['candidate']['ssc']) ?? "";
            document.getElementById('hsc').value= hscEditor.setData(res.data['candidate']['hsc']) ?? "";
            document.getElementById('hons').value= honsEditor.setData(res.data['candidate']['hons']) ?? "";
            document.getElementById('otherQualification').value= otherQualificationEditor.setData(res.data['candidate']['other_qualification']) ?? "";

        }catch (e) {
           unauthorized(e.response.status)
        }
    }


    async function onUpdate(){
        let image = document.getElementById('image').files[0];
        let address = document.getElementById('address').value;

        let formData = new FormData();
        formData.append('image', image); // Append the image file
        formData.append('address', address);
        formData.append('ssc', sscEditor.getData());
        formData.append('hsc', hscEditor.getData());
        formData.append('hons', honsEditor.getData());
        formData.append('other_qualification', otherQualificationEditor.getData());
        showLoader();
        let res=await axios.post("/api/candidate-update",formData,HeaderToken());
        hideLoader();
        if(res.data['status']==="success"){
            successToast(res.data['message'])
            await getProfile();
        }
        else {
            successToast(res.data['message'])
        }


    }


</script>

