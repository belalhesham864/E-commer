import "./bootstrap";

if (typeof layout !== "undefined" && layout === "admin" && typeof adminId !== "undefined") {

    window.Echo.private("admins." + adminId).notification((event) => {
        $("#no_notifications_msg").remove();

      if(event.type=='CreateOrderNotification'){
            var url = showOrderRoute.replace(':id', event.order_id) + '?notify_admin=' + event.id;

        $("#pushRealTime").prepend(`
            <a href="${url}">
                <div class="media">
                    <div class="media-left align-self-center">
                        <i class="ft-plus-square icon-bg-circle bg-cyan"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading">${event.messages}</h6>
                        <p class="notification-text font-small-3 text-muted">
                            Order From : ${event.user_name}. -EGP ${event.total_price}
                        </p>
                        <small>
                            <time class="media-meta text-muted">${event.created_at}</time>
                        </small>
                    </div>
                </div>
            </a>
        `);


      }
      if(event.type=='ContactUsNotification'){
        var url = contectindexRoute + '?notify_admin=' + event.id;
          $("#pushRealTime").prepend(`
              <a href="${url}"
       class="d-block text-decoration-none">

        <div class="media p-2"
             style="background: #f0fff7; border-left: 4px solid #28a745; border-radius: 6px;">

            <div class="media-left align-self-center mr-2">
                <i class="ft-mail icon-bg-circle bg-success"></i>
            </div>

            <div class="media-body">
                <h6 class="media-heading text-success font-weight-bold">
                    ${event.message ?? 'New Contact Message'} }}
                </h6>

                <p class="notification-text font-small-3 text-muted mb-1">
                    <i class="ft-user"></i>
                    From: ${event.user_name ?? 'Unknown'} }}
                </p>

                <p class="notification-text font-small-3 text-muted mb-1">
                    <i class="ft-mail"></i>
                    ${event.user_email ?? ''} }}
                </p>

                <small class="text-muted">
                    <i class="ft-clock"></i>
                   ${event.created_at}
                </small>
            </div>
        </div>
    </a>
            `);
      }
          let count = parseInt($("#notification_count").text(), 10) || 0;
        $("#notification_count").text(count + 1);

        let countInside = parseInt($("#notification_count_inside").text(), 10) || 0;
        $("#notification_count_inside").text((countInside + 1) + " New");
    });

}

