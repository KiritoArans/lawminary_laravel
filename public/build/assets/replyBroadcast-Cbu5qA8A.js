import{P as t,E as i}from"./pusher-BLwKsXut.js";t.logToConsole=!0;window.Echo=new i({broadcaster:"pusher",key:"c41885dad45d1f907ea8",cluster:"ap1",forceTLS:!1});document.addEventListener("DOMContentLoaded",function(){console.log("Echo setup for replies initialized");let n=[];document.querySelectorAll('[id^="replies-"]').forEach(function(s){let e=s.id.split("-")[1];console.log("Listening for replies on comment ID:",e),n.includes(e)?console.log("Already listening for replies on comment ID:",e):(n.push(e),window.Echo.channel("replies."+e).listen("ReplyCreated",o=>{console.log("Event received for comment ID "+e+":",o);let r=`
                        <div class="user-reply">
                            <div>
                                <img src="${o.user_photo_url}" alt="User Profile Picture" class="user-profile-photo" />
                            </div>
                            <div class="user-reply-content">
                                <span>
                                    <a href="/profile/${o.user_id}">
                                        ${o.user_name}
                                    </a>
                                </span>
                                <p>${o.reply}</p>
                                <div class="date-reply">
                                    <p class="comment-time">Just now</p>
                                </div>
                            </div>
                        </div>
                    `,l=document.getElementById("replies-"+e);l?(l.innerHTML+=r,console.log("New reply added to the reply section of comment ID "+e)):console.error("Reply section not found for comment ID:",e)}))})});
