
window.addEventListener('load', function(){
    window.Echo.private('users.' + user_id)
        .listen('GroupCreated', (e) => {
            // if (document.querySelector(`li[id="${e.group.identifier}"][data-id="${e.group.id}"]`).length == 0) {
                // if(e.group.rfq_id != null) {
                //     document.getElementById('group-list-'+e.group.rfq_id).append(e.html);
                //     document.getElementById('rfq-chat-list').append(e.html);
                // } else if (e.group.rfq_id == null && e.group.ccg_id == null) {
                //     document.getElementById('general-chat-list').append(e.html);
                // }
                // this.groups.push(e.group.id);
            // }
            if (document.querySelector(`li[id="${e.identifier}"][data-id="${e.id}"]`) === null) {
                $.getJSON(baseUrl+'/admin/get/group/'+e.id, function(response){
                    if(e.rfq_id != null) {
                        document.getElementById('group-list-'+e.rfq_id).insertAdjacentHTML("beforeend", response.data);
                        document.getElementById('rfq-chat-list').insertAdjacentHTML("beforeend", response.data);
                    } else if (e.rfq_id == null && e.ccg_id == null) {
                        document.getElementById('general-chat-list').insertAdjacentHTML("beforeend", response.data);
                    } 
                }).then(function(response){
                    this.groups.push(e.id);
                });
            }
        });
    
    window.Echo.channel('delete-message')
        .listen('DeleteConversation', (e) => {
            deleteMessage(e);
        });
        
        //listen for new messages in groups
        for (key in this.groups) {
            subscribeGroup(groups[key]);
        }
});

// add event listener for load more messages

let messageBox = document.getElementById('message-box');
let docBox = document.getElementById('group-doc');
const scroller = document.querySelector("#message-box");
let onLoadScrollHeight = scroller.scrollTop;

scroller.addEventListener("scroll", (event) => {
    if (scroller.scrollTop < onLoadScrollHeight && scroller.scrollTop <= 0) {
        if (scroller.firstChild.getAttribute('data-id')) {
            getMessages(scroller.getAttribute('data-id'), scroller.firstChild.getAttribute('data-id'), false, true);
        }
    }
});

function subscribeGroup(group) {

    window.Echo.private('groups.' + group.id)
            .listen('NewMessage', (e) => {
                $.getJSON(baseUrl+'/admin/get/conversation/'+e.id, function(response){
                    appendMessageBox(group.id, response.data.chat, response.data.doc)
                });
            });
    // window.Echo.private('groups.' + group.id)
    //         .listen('LoadOldMessage', (e) => {
    //             populateGroupMessageBoxDiv(group.id, e.chat)
    //         });

}

function deleteMessage(e) {
    const conversationNode = document.querySelector(`div[class="chat-mid-text"][data-id="${e.conversation_id}"] > p`);
    conversationNode.innerHTML = `<i>This message is deleted</i>`;
    const docNode = document.querySelector(`li[data-id="${e.conversation_id}"]`);
    docNode.remove();
    document.querySelector(`div[class="chat-mid-text"][data-id="${e.conversation_id}"] > div[class="row"]`).remove();
}

function scrollToBottom(element) {
    element.scrollTop = element.scrollHeight;
    onLoadScrollHeight = element.scrollTop;
}

function appendMessageBox(groupId, chat, doc)
{
    // console.log(chat);
    // chat.classList.remove();
    // chat = chat.replace('chat-view-mid-r', '')
    if (messageBox.getAttribute('data-id') == groupId) {  
        if (document.getElementById('no-count')) {
            document.getElementById('no-count').remove();
        }
        messageBox.insertAdjacentHTML("beforeend", chat);
        docBox.insertAdjacentHTML("beforeend", doc);
    }
    scrollToBottom(messageBox);
}


function populateGroupMessageBoxDiv(groupId, data, flag=true, append = false)
{

    if (messageBox.getAttribute('data-id') != groupId) {
        messageBox.setAttribute('data-id', groupId);
    }

    // check if the data should be appended
    if (append) {
        messageBox.insertAdjacentHTML("afterbegin", data.chat);
        docBox.insertAdjacentElement("afterend", data.doc);
    } else {
        messageBox.innerHTML = data.chat;
        docBox.innerHTML = data.doc;
        document.getElementById('chat-info').innerHTML=data.info;
    }

    if (flag) {
        // scroll only if flag is true
        scrollToBottom(messageBox);
    }
}

// make ajax call

function getMessages(groupId, offset=null, flag=true, append=false) {
    let url = baseUrl+'/admin/chat/groups/' + groupId;
    if (offset != null) {
        url +=  '/' + offset;
    }
    if (!append) {
        document.getElementById('message-box').innerHTML = `<div class="chat-spinner"><span class="spinner-border justify-content-center" role="status" aria-hidden="true"></span></div>`;
    }
    $.get(url, (response) => {
        populateGroupMessageBoxDiv(groupId, response.data, flag, append)
        document.getElementById('chat-group-id').value = groupId;
    });
}

function loadGroup(group) {
    // group = JSON.parse(group);
    if (document.getElementById('message-box').getAttribute('data-id') != group) {
        getMessages(group, null, true, false);
    } 
}

$(document).ready(function() {
    
    
    $("body").on("change", "#post-attachments", function (e) {
        attachmentDataTransfer.clearData();
        $(".post-attachment-preview").html("");
        if (attachmentDataTransfer.files.length > 0) {
            attachmentDataTransfer = new DataTransfer();
        }
        let fileLists = this.files;
        for (let file of fileLists) {
            attachmentDataTransfer.items.add(file);
        }
        $.each(fileLists, function (index, filelist) {
            validateFile(this, filelist, attachmentValid, "post-attachment-preview", false, true);
        });
    });
    
    $("body").on("change", "#post-chat-file", function (e) {
        imgDataTransfer.clearData();
        $(".post-img-preview").html("");

        // if (imgDataTransfer.files.length > 0) {
        //   imgDataTransfer = new DataTransfer();
        // }
        let fileLists = this.files;
        console.log("fileLists >>", fileLists);
        let x = 0;
        for (let file of fileLists) {
            imgDataTransfer.items.add(file);
            x++;
        }

        $.each(fileLists, function (index, filelist) {
            validateFile(this, filelist, imgValid, "post-img-preview", false);
        });
    });

    $("body").on("submit", "#group-message-form", function (e) {
        e.preventDefault();
        let url = $(this).attr("action");
        let flag = true;
        let formData = new FormData();
        
        let description = $('input[name="message"]').val();
        let group_id = $('input[name=group_id]').val();
        if (flag) {
            formData.append("_token", csrf);
            formData.append("message", description);
            if (group_id.trim() !== undefined || group_id.trim() != "") {
                formData.append("group_id", group_id);
            } else {
                alert("Please select a group");
                return false;
            }
            console.log("imgDataTransfer.files >>", imgDataTransfer.files);
            if (imgDataTransfer.files.length > 0) {
                for (let x = 0; x < imgDataTransfer.files.length; x++) {
                    formData.append(`files[]`, imgDataTransfer.files[x]);
                }
            }

            if (attachmentDataTransfer.files.length > 0) {
                for (let x = 0; x < attachmentDataTransfer.files.length; x++) {
                    formData.append(`attachments[]`, attachmentDataTransfer.files[x]);
                }
            }
            $(".send-message-btn").prop("disabled", true);
            $(".post-attachment-preview").html("");
            $(".post-img-preview").html("");

            $.ajax({
                url: `${url}`,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(".send-message-btn").prop("disabled", true);
                    $(".send-message-btn").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`);    
                },
                success: function (response) {
                    if (response.status.trim() === "success") {
                        if (document.getElementById('no-count')) {
                            document.getElementById('no-count').remove();
                        }
                        $("body").find("div#message-box").append(response.data.chat);
                        $("body").find("ul#group-doc").append(response.data.doc);
                        scrollToBottom(messageBox);
                        $("#group-message-form").trigger('reset');
                        $("body").find(`div[class="chat-mid-text"][data-id="${response.data.conversation_id}"]`).find('span.chat-delete').html(`<a href="${response.data.delete_uri}"><i class="bi bi-trash"></i></a>`);
                    } else if (response.status.trim() === "error") {
                        alert(response.message);
                    }
                },
                complete: function () {
                    $(".send-message-btn").prop("disabled", false);
                    $(".send-message-btn").html(`Send`);
                },
            });
        }
    });

    $('body').on('click', 'span.chat-delete > a', function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this')) {
            $.get($(this).attr('href'), (response) => {
                if (response.status == 'success') {
                    $(this).closest('div.chat-mid-text > p').html(`<i>This message is deleted</>`);
                    $(this).closest('div.chat-mid-text > span.chat-delete').remove();
                    $(this).closest('div.chat-mid-text > div.row').remove();
                    $('body').find('ul#group-doc').find(`li[data-id="response.data"]`).remove();
                }
            });
        }
    });

});

// $('body').on('click', '.rfqs-name-list', function(){
//     $(this).parent().hide();
//     $('.event-rfqs-chats').show();
// })

// $('body').on('click', '#rfq-title', function(){
//     $(this).parent().hide();
//     $(".all-rfq-listing").show();
// })