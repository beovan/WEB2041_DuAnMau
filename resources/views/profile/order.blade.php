<div class="tab-pane" id="order">
    <div class="timeline timeline-inverse">
        @foreach($orders as $order)
            @if ($order->customer->user_id === $user_id)
                <div class="time-label">
                    <span class="bg-success">
                        {{ $order->order_date }}
                    </span>
                </div>

                <div>
                    <i class="fas fa-envelope bg-primary"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> 12:05</span>
                        <h3 class="timeline-header"><a href="#">Order Information</a></h3>
                        <div class="timeline-body">
                            <!-- Display order-related information here -->
                            <ul>
                                <li> Order number: {{ $order->order_number }}</li>
                                <li> Customer: {{ $order->customer->name }}</li>
                            </ul>
                            <!-- Add more order information here -->
                        </div>
                        <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
