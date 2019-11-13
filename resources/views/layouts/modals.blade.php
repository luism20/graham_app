<div class="modal fade" id="onboarding" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form name="fileType" method="GET" onsubmit="return validateForm()" action="importData">
            <div class="modal-header">                
                <h4>Choose how you want to import your data</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 pointer"  onclick="selectRadio('quickbooks')">
                        <div class="small-box">
                            <div class="inner">
                                <h3>File</h3>
                                <p>Quickbooks</p>
                            </div>
                            <div class="icon">
                                <i class="ion  ion-document"></i>
                            </div>
                            <div class="small-box-footer"><input type="radio" id="quickbooks" name="onboarding" required value="quickbooks"></div>  
                        </div>
                    </div>                
                    <div class="col-md-4 pointer"  onclick="selectRadio('siesa')">
                        <div class="small-box">
                            <div class="inner">
                                <h3>File</h3>
                                <p>Siesa</p>
                            </div>
                            <div class="icon">
                                <i class="ion  ion-document"></i>
                            </div>
                            <div class="small-box-footer"><input type="radio" name="onboarding" id="siesa" required value="siesa"></div>                       
                        </div>
                    </div>
                    <div class="col-md-4 pointer" onclick="selectRadio('excel')">
                        <div class="small-box">
                            <div class="inner">
                                <h3>File</h3>
                                <p>Excel</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document"></i>
                            </div> 
                            <div class="small-box-footer"><input type="radio" name="onboarding" id="excel" required value="excel"></div>                         
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" value="Next">
            </div>
        </div>
    </div>
</div>
<script>
    function selectRadio(value){
        var $radios = $('input:radio[name=onboarding]');
        if($radios.is(':checked') === false) {
            $radios.filter('[value=' + value + ']').prop('checked', true);
        }
    }

    function validateForm() {
        var fileType = document.getElementsByName('onboarding');
        var fileType_value;
        for(var i = 0; i < fileType.length; i++){
            if(fileType[i].checked){
                fileType_value = fileType[i].value;
            }
        }
        if (fileType_value != "excel") {
            $.alert({
                title: 'Message:',
                content: fileType_value + " is not available",
                type: 'orange',
            });
            return false;
        }
    }
</script>