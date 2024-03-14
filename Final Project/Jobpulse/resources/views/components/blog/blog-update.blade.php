<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Blog</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Text</label>
                                <textarea type="text" class="form-control" id="textUpdate"></textarea>
                                <input type="text" class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'textUpdate');

    async function FillUpUpdateForm(id){
        try {

            let textUpdateEditor = CKEDITOR.instances['textUpdate'];

            document.getElementById('updateID').value=id;
            showLoader();
            let res=await axios.post("/api/blog-by-id",{id:id.toString()},HeaderToken())
            hideLoader();

            document.getElementById('textUpdate').value= textUpdateEditor.setData(res.data['rows']['text']);
        }catch (e) {
            unauthorized(e.response.status)
        }
    }



    async function update() {
        // return console.log(CKEDITOR.instances['blogCompanyHistoryUpdate'].getData());
        try {
            let textUpdateEditor = CKEDITOR.instances['textUpdate'];

            let textUpdateUpdate = textUpdateEditor.getData();
            let updateID = document.getElementById('updateID').value;
            document.getElementById('update-modal-close').click();

            let PostBody= {
                "text":textUpdateUpdate,
                "id":updateID
            }

            showLoader();
            let res = await axios.post("/api/update-blog",PostBody,HeaderToken())
            hideLoader();
            if(res.data['status']==="success"){
                successToast(res.data['message'])
                await getList();
            }
            else{
                errorToast(res.data['message'])
            }

        }catch (e) {
            unauthorized(e.response.status)
        }

    }
</script>
