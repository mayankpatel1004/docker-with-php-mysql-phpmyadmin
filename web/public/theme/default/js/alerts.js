(function($) {
  showSwal = function(type) {
    'use strict';
    if (type === 'basic') {
      swal({
        text: 'Any fool can use a computer',
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })

    } else if (type === 'title-and-text') {
      swal({
        title: 'Read the alert!',
        text: 'Click OK to close this alert',
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })

    } else if (type === 'success-message') {
      swal({
        title: 'Congratulations!',
        text: 'You entered the correct answer',
        icon: 'success',
        button: {
          text: "Continue",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })

    } 
    else if (type === 'success-comment') {
      swal({
        title: 'Congratulations!',
        text: 'Your data successfully submitted',
        icon: 'success',
        button: {
          text: "Continue",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })
    }
    else if (type === 'auto-close') {
      swal({
        title: 'Auto close alert!',
        text: 'I will close in 2 seconds.',
        timer: 2000,
        button: false
      }).then(
        function() {},
        // handling the promise rejection
        function(dismiss) {
          if (dismiss === 'timer') {
            console.log('I was closed by the timer')
          }
        }
      )
    } else if (type === 'warning-message-and-cancel') {
      swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Great ',
        buttons: {
          cancel: {
            text: "Cancel",
            value: null,
            visible: true,
            className: "btn btn-danger",
            closeModal: true,
          },
          confirm: {
            text: "OK",
            value: true,
            visible: true,
            className: "btn btn-primary",
            closeModal: true
          }
        }
      })

    } 
    
    else if (type === 'confirm-delete') {
      swal({
        title: 'Are you sure you want to perform this action?',
        text: "Please confirm your action!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Great ',
        buttons: {
          cancel: {
            text: "Cancel",
            value: null,
            visible: true,
            className: "btn btn-danger",
            closeModal: true,
          },
          confirm: {
            text: "OK",
            value: true,
            visible: true,
            className: "btn btn-primary",
            closeModal: true
          }
        }
      }).then(function(confirm){
        if(confirm) {
          var itemaction = document.getElementById('actionbox').value;
          var url = $("#site_url").val()+''+$("#page_controller").val()+'/listAction';
          var sList = "";
          var chkboxid = "";
          $('.chkbox').each(function () {
              if(this.checked){
                  sList += $(this).val()+",";
              }
          });
          if(sList.slice(0,-1) != ""){
              chkboxid = sList.slice(0,-1);
          }
          if(itemaction == ''){
              swal(
                'Warning!',
                'Please select atleast one action from dropdown.',
                'warning'
              );
              return false;
          }
          else if(chkboxid == ''){
              swal(
                'Warning!',
                'Please select atleast one check box to perform your action.',
                'warning'
              );
              return false;
          } else {
            var sList = "";
            var chkboxid = "";
            $('.chkbox').each(function () {
                if(this.checked){
                    sList += $(this).val()+",";
                }
            });
            if(sList.slice(0,-1) != ""){
                chkboxid = sList.slice(0,-1);
                $.ajax({
                type: 'POST',
                url: url,
                data:'action='+$("#actionbox").val()+'&ids='+chkboxid,
                beforeSend: function () {
                    $('.loading-overlay').show();
                },
                success: function (response) {
                    //console.log(response);
                    //data = JSON.parse(response);
                    //$("#data_response").html(data.data);
                    swal(
                      'Success!',
                      'Status has been successfully updated.',
                      'success'
                    );
                    setTimeout(function(){location.reload();}, 2000);
                }
              });    
            }
          }
        }
      });
    }
    else if (type === 'confirm-empty') {
      swal({
        title: 'Are you sure you want to perform this action?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f51b5',
        cancelButtonColor: '#ff4081',
        confirmButtonText: 'Great ',
        buttons: {
          cancel: {
            text: "Cancel",
            value: null,
            visible: true,
            className: "btn btn-danger",
            closeModal: true,
          },
          confirm: {
            text: "OK",
            value: true,
            visible: true,
            className: "btn btn-primary",
            closeModal: true
          }
        }
      }).then(function(confirm){
        if(confirm) {
          let url = $('#site_url').val()+"Home/emptycart";
          $.ajax({
              type: 'POST',
              url: url,
              data:'cart_id='+$("#cart_id").val(),
              beforeSend: function () {
                  $('.loading-overlay').show();
              },
              success: function (response) {
                  swal(
                  'Success!',
                  'Your cart is empty now. Please continue shopping',
                  'success'
                  );
                  //setTimeout(function(){location.reload();}, 2000);
              }
          });
        }
      });
    }
    else if (type === 'custom-html') {
      swal({
        content: {
          element: "input",
          attributes: {
            placeholder: "Type your password",
            type: "password",
            class: 'form-control'
          },
        },
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })
    }
    else if (type === 'contact-success') {
      swal({
        title: 'Congratulations!',
        text: 'Your form has been successfully submitted. Someone from our team will reach you soon.',
        icon: 'success',
        button: {
          text: "Continue",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      })

    }
  }

})(jQuery);