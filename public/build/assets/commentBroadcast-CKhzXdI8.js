import{P as r,E as c}from"./pusher-BLwKsXut.js";r.logToConsole=!0;window.Echo=new c({broadcaster:"pusher",key:"c41885dad45d1f907ea8",cluster:"ap1",forceTLS:!1});document.addEventListener("DOMContentLoaded",function(){console.log("Echo setup initialized");let t=[];document.querySelectorAll('[id^="comment-area-"]').forEach(function(s){let e=s.id.split("-")[2];console.log("Listening for comments on post ID:",e),t.includes(e)?console.log("Already listening to comments on post ID:",e):(t.push(e),window.Echo.channel("comments."+e).listen("CommentCreated",o=>{console.log("Event received for post ID "+e+":",o);let l=`
                        <div class="user-comment">
                            <div>
                                <img src="${o.user_photo_url}" alt="User Profile Picture" class="user-profile-photo" />
                            </div>
                            <div class="user-comment-content">
                                <span>
                                    <a href="/profile/${o.user_id}">
                                        ${o.user_name}
                                    </a>
                                </span>
                                <p>${o.comment}</p>
                                <div class="date-reply">
                                    <p class="comment-time">Just now</p>
                                </div>
                            </div>
                        </div>
                    `,n=document.getElementById("comment-area-"+e);n?(n.innerHTML+=l,console.log("New comment added to the comment area of post ID "+e)):console.error("Comment area not found for post ID:",e)}))})});
