function showLoader() {
    document.getElementById('loader').classList.remove('d-none')
}
function hideLoader() {
    document.getElementById('loader').classList.add('d-none')
}

function successToast(msg) {
    Toastify({
        gravity: "bottom", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        text: msg,
        className: "mb-5",
        style: {
            background: "green",
        }
    }).showToast();
}

function errorToast(msg) {
    Toastify({
        gravity: "bottom", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        text: msg,
        className: "mb-5",
        style: {
            background: "red",
        }
    }).showToast();
}


function unauthorized(code){
    if(code===401){
        clearSessionAndStorage()
    }
}

function clearSessionAndStorage() {
    localStorage.clear();
    sessionStorage.clear();
    window.location.href="/"
}
function setToken(token){
    localStorage.setItem("token",`Bearer ${token}`)
}

function getToken(){
   return  localStorage.getItem("token")
}


function HeaderToken(){
   let token=getToken();
   return  {
        headers: {
            Authorization:token
        }
    }
}

function HeaderTokenWithBlob(){
    let token=getToken();
    return  {
        responseType: 'blob',
        headers: {
            Authorization:token
        }
    }
}


// user section 
async function userCreate() {

    try {
        showLoader();
        let res=await axios.get("/api/list-role",HeaderToken());
        hideLoader();

        const roles = res.data['rows']
        if (roles) {
            let options = `<option value="">Select</option>`
            for (const roleId in roles) {
                console.log(roles[roleId]);
                options += `<option value="${roles[roleId]['id']}">${roles[roleId]['name']}</option>`
            }
            document.getElementById('role').innerHTML=options;
        }
    }catch (e) {
        unauthorized(e.response.status)
    }
}

async function userSave() {
        try {
            let data = {
               firstName : document.getElementById('firstName').value,
               lastName : document.getElementById('lastName').value,
               email : document.getElementById('email').value,
               mobile : document.getElementById('mobile').value,
               password : document.getElementById('mobile').value,
               roleId: document.getElementById('role').value,

            }
            document.getElementById('modal-close').click();
            showLoader();
            let res = await axios.post("/api/create-admin",data,HeaderToken())
            hideLoader();

            if(res.data['status']==="success"){
                successToast(res.data['message']);
                document.getElementById("save-form").reset();
                await getUserList();
            }
            else{
                errorToast(res.data['message'])
            }

        }catch (e) {
            unauthorized(e.response.status)
        }
}

async function getUserList() {

   try {
       showLoader();
       let res=await axios.get("/api/list-admin",HeaderToken());
       hideLoader();

       let tableList=$("#tableList");
       let tableData=$("#tableData");

       tableData.DataTable().destroy();
       tableList.empty();
    //    return console.log(res);

       res.data['rows'].forEach(function (item,index) {
           let row=`<tr>
                    <td>${index+1}</td>
                    <td>${item['firstName']}</td>
                    <td>${item['lastName']}</td>
                    <td>${item['email']}</td>
                    <td>${item['mobile']}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                 </tr>`
           tableList.append(row)
       })

       $('.editBtn').on('click', async function () {
           let id= $(this).data('id');
           await FillUpUserUpdateForm(id)
           $("#update-modal").modal('show');
       })

       $('.deleteBtn').on('click',function () {
           let id= $(this).data('id');
           $("#delete-modal").modal('show');
           $("#deleteID").val(id);
       })

       new DataTable('#tableData',{
           order:[[0,'desc']],
           lengthMenu:[5,10,15,20,30]
       });

   }catch (e) {
       unauthorized(e.response.status)
   }

}

async function FillUpUserUpdateForm(id){
       try {
           document.getElementById('updateID').value=id;
           showLoader();
           let res=await axios.post("/api/admin-by-id",{id:id},HeaderToken())
           hideLoader();

           document.getElementById('adminFirstNameUpdate').value=res.data['rows']['firstName'];
           document.getElementById('adminLastNameUpdate').value=res.data['rows']['lastName'];
           document.getElementById('adminEmailUpdate').value=res.data['rows']['email'];
           document.getElementById('adminMobileUpdate').value=res.data['rows']['mobile'];

           const roles = res.data['rows']['allRoles']
           const roleIds = res.data['rows']['roleIds']
            if (roles) {
                let options = `<option value="">Select</option>`
                for (const roleId in roles) {
                    options += `<option value="${roleId}" ${roleIds.indexOf(parseInt(roleId)) != -1 ? 'selected' :''}>${roles[roleId]}</option>`
                }
                document.getElementById('adminRoleUpdate').innerHTML=options;
            }
       }catch (e) {
           unauthorized(e.response.status)
       }
}

async function userUpdate() {

       try {
            // return console.log(document.getElementById('updateID').value);
            let data = {
                id:  document.getElementById('updateID').value,
                firstName: document.getElementById('adminFirstNameUpdate').value,
                lastName: document.getElementById('adminLastNameUpdate').value,
                email: document.getElementById('adminEmailUpdate').value,
                mobile: document.getElementById('adminMobileUpdate').value,
                roleId: document.getElementById('adminRoleUpdate').value,
                updateID:  document.getElementById('updateID').value,
            };

           document.getElementById('update-modal-close').click();
           showLoader();
           let res = await axios.post("/api/update-admin",data,HeaderToken())
           hideLoader();
        //    return console.log(res);

           if(res.data['status']==="success"){
               document.getElementById("update-form").reset();
               successToast(res.data['message'])
               await getUserList();
           }
           else{
               errorToast(res.data['message'])
           }

       }catch (e) {
           unauthorized(e.response.status)
       }
}

    
async  function  userDelete(){
    try {
        let id=document.getElementById('deleteID').value;
        document.getElementById('delete-modal-close').click();
        showLoader();
        let res=await axios.post("/api/delete-admin",{id:id},HeaderToken())
        hideLoader();
        if(res.data['status']==="success"){
            successToast(res.data['message'])
            await getUserList();
        }
        else{
            errorToast(res.data['message'])
        }
    }catch (e) {
        unauthorized(e.response.status)
    }
}



// role section 
async function getRoleList() {

   try {
       showLoader();
       let res=await axios.get("/api/list-role",HeaderToken());
       hideLoader();
        // return console.log(res);
       let tableList=$("#tableList");
       let tableData=$("#tableData");

       tableData.DataTable().destroy();
       tableList.empty();
    //    return console.log(res);

       res.data['rows'].forEach(function (item,index) {
        console.log(item['name']);
           let row=`<tr>
                    <td>${index+1}</td>
                    <td>${item['name']}</td>
                    <td>${item['guard_name']}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                 </tr>`
           tableList.append(row)
       })

       $('.editBtn').on('click', async function () {
           let id= $(this).data('id');
           await FillUpUpdateForm(id)
           $("#update-modal").modal('show');
       })

       $('.deleteBtn').on('click',function () {
           let id= $(this).data('id');
           $("#delete-modal").modal('show');
           $("#deleteID").val(id);
       })

       new DataTable('#tableData',{
           order:[[0,'desc']],
           lengthMenu:[5,10,15,20,30]
       });

   }catch (e) {
       unauthorized(e.response.status)
   }

}
