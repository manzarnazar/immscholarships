@extends('../layout/base')

@section('body')
    <body>
        @yield('content')
        @include('sweetalert::alert')

        @include('../layout/components/dark-mode-switcher')
        @include('../layout/components/main-color-switcher')

        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG7gNHAhDzgYmq4-EHvM4bqW1DNj2UCuk&libraries=places"></script>
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
            integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- <script src="https://cdn.tailwindcss.com/"></script> --}}
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('assets/toastr/js/toastr.min.js') }}"></script>
        <script src="{{ asset('assets/toastr/js/toastr.init.js') }}"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

        {{-- <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script> --}}
        {{-- <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.dataTables.js"></script> --}}
        <!-- END: JS Assets-->

        @yield('script')

        <script>
            var notificationRoute = "{{ route('notification.show', '__ID__') }}"; // Blade generates the route
        </script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '.mark-as-read-btn', function() {
                    var notificationId = $(this).data('id');
                    markAsRead(notificationId);
                });

                $(document).on('click', '.all-read', function() {
                    markAllAsRead();
                });
                // Function to fetch notifications
                function fetchNotifications() {
                    $.ajax({
                        url: '/dashboard/admin/notifications', // The route to fetch notifications
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            let notifications = response;

                            let notificationHTML = '<div class="notification-content__title">Notifications</div>';
                            let hasUnreadNotifications = false; // Variable to track if there are unread notifications

                            if (Array.isArray(notifications) && notifications.length > 0) {
                                // Check if there are unread notifications
                                hasUnreadNotifications = notifications.some(notification => !notification.read_at);

                                // Clear the existing notifications in the container
                                document.querySelector('.notification-content__box').innerHTML = '';

                                // Iterate through notifications and append each to the container
                                notifications.forEach(notification => {
                                    // For admin, show the avatar image, for student show ✔ or ❌
                                    let imageContent = '';
                                    if (notification.user_type === 'student') {
                                        imageContent = `
                                            <div class="w-12 h-12 flex-none text-center mr-1">
                                                <div class="text-3xl ${notification.status_icon === 'approved' ? 'text-green-500' : 'text-red-500'}">
                                                    ${notification.status_icon === 'approved' ? '✔' : '❌'}
                                                </div>
                                            </div>
                                        `;
                                    } else {
                                        // For admin, display avatar or other admin-specific content
                                        imageContent = `
                                            <div class="w-12 h-12 flex-none image-fit mr-1">
                                                < img alt="User Avatar" class="rounded-full" src="${notification.image_path}">
                                                <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600"></div>
                                            </div>
                                        `;
                                    }

                                    notificationHTML += `
                                        <div class="cursor-pointer relative flex items-center ${notification.read_at ? '' : 'mt-5'}" id="notification-${notification.id}">
                                            <!-- Unread indicator (Blue Dot) -->
                                            <div class="w-3 h-3 bg-blue-500 rounded-full absolute left-[-15px] ${notification.read_at ? 'hidden' : 'block'}"></div>

                                            ${imageContent}

                                            <div class="ml-2 overflow-hidden">
                                                <div class="flex items-center">
                                                    <a href=" '__ID__', notification.id)}" class="font-medium truncate mr-5">${notification.student_name}</a >
                                                    <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">${new Date(notification.created_at).toLocaleString()}</div>
                                                </div>
                                                <div class="w-full truncate text-slate-500 mt-0.5">${notification.message}</div>

                                                <!-- Mark as Read Button -->
                                                <button class="text-xs text-blue-500 mt-2 mark-as-read-btn" data-id="${notification.id}">Mark as Read</button>
                                            </div>
                                        </div>
                                    `;
                                });

                                // Add Mark All as Read button if there are any unread notifications
                                if (notifications.some(notification => !notification.read_at)) {
                                    notificationHTML += `
                                        <div class="cursor-pointer relative py-2 flex justify-center items-center mt-2">
                                            <button class="text-xs text-blue-500 all-read">Mark All as Read</button>
                                        </div>
                                    `;
                                }

                                // Insert all generated notifications HTML into the container
                                document.querySelector('.notification-content__box').innerHTML = notificationHTML;
                            } else {
                                notificationHTML += `
                                    <div class="cursor-pointer relative py-2 flex justify-center items-center">
                                        <div class="text-center text-slate-500">No notifications</div>
                                    </div>
                                `;
                                document.querySelector('.notification-content__box').innerHTML = notificationHTML;
                            }

                            // Dynamically update the bell icon if there are unread notifications
                            if (hasUnreadNotifications) {
                                document.querySelector('.dropdown-toggle.notification').classList.add('notification--bullet');
                            } else {
                                document.querySelector('.dropdown-toggle.notification').classList.remove('notification--bullet');
                            }
                        },
                        error: function(error) {
                            console.log("Error fetching notifications:", error);
                        }
                    });
                }

                setInterval(fetchNotifications, 5000);

                function markAsRead(notificationId) {
                    $.ajax({
                        url: `/dashboard/admin/notifications/mark-as-read/${notificationId}`, // Route to mark a single notification as read
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                // If successful, update the notifications UI
                                fetchNotifications(); // Refresh notifications to mark them as read
                            } else {
                                console.log('Failed to mark notification as read.');
                            }
                        },
                        error: function(error) {
                            console.log("Error marking notification as read:", error);
                        }
                    });
                }

                function markAllAsRead() {
                    $.ajax({
                        url: '/dashboard/admin/notifications/mark-all-as-read', // Route to mark all notifications as read
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                // If successful, update the notifications UI
                                fetchNotifications(); // Refresh notifications to mark them as read
                            } else {
                                alert('Failed to mark all notifications as read.');
                            }
                        },
                        error: function(error) {
                            console.log("Error marking all notifications as read:", error);
                        }
                    });
                }
            });
        </script>

        <script>
            @if (Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";
                switch (type) {
                    case 'info':
                        toastr.info(" {{ Session::get('message') }} ");
                        break;
                    case 'success':
                        toastr.success(" {{ Session::get('message') }} ");
                        break;
                    case 'warning':
                        toastr.warning(" {{ Session::get('message') }} ");
                        break;
                    case 'error':
                        toastr.error(" {{ Session::get('message') }} ");
                        break;
                }
            @endif
        </script>
    </body>
@endsection
