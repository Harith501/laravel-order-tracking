@extends('layouts.app')

@section('title', 'Create New Order')

@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Create New Order</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Order No</label>
                        <input type="text" name="order_no" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Installation Date</label>
                        <input type="date" name="installation_date" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Exchange</label>
                        <input type="text" name="exchange" class="form-control" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Work Activity</label>
                        <select name="work_activity" class="form-select" required>
                            <option value="">-- Select --</option>
                            @foreach([
                                'HSBB - FTTH(OH) & H/RISE',
                                'HSBB - FTTH(UG)',
                                'HSBB - UNIFI VDSL',
                                'HSBB - MODIFY ORDER',
                                'HSBA - FTTH(OH) & H/RISE',
                                'HSBA - FTTH(UG)',
                                'HSBA - UNIFI VDSL',
                                'FTTH(OH) HR UG(ACCESS SEEKER)',
                                'FTTH(OH) HR UG(SHARED BTU ODR)',
                                'CTT',
                                'SEM:INSTL UI WITH COMBO BOX OH & HR',
                                'SEM:INSTL UI WITH COMBO BOX UG'
                            ] as $activity)
                                <option value="{{ $activity }}">{{ $activity }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">ID Slot Order</label>
                        <select name="id_slot_order" class="form-select" required>
                            <option value="">-- Select --</option>
                            @foreach([
                                'Q100019 (MOHAMAD RAZIFF BIN MAJID)',
                                'Q105340 (MOHD RAHIMI BIN MOHD RHAZI)',
                                'Q106147 (MOHD FIRDAUS BIN MOHD NOR)',
                                'Q109282 (MUHAMMAD RIFQI DANISH BIN ROSLAN)',
                                'Q107649 (MUHAMMAD FAIZ BIN ABDULLAH)'
                            ] as $slot)
                                <option value="{{ $slot }}">{{ $slot }}</option>
                            @endforeach
                        </select>
                    </div>

                    @php
                        $team = ['AJIS','AZRUL','DANISH','FIRDAUS','KADIAQ','RAHIMI','SHARIL','SINOR ADMIN'];
                        $member1 = [
                            'TIADA(JALAN 1 ORG SHJ)',
                            'AJIS','AZRUL','DANISH','FIRDAUS','KADIAQ','RAHIMI','SHARIL'
                        ];
                        $member2 = [
                            'TIADA(JALAN 1 ORG SHJ)',
                            'TIADA(JALAN 2 ORG SHJ)',
                            'AJIS','AZRUL','DANISH','FIRDAUS','KADIAQ','RAHIMI','SHARIL'
                        ];
                        $member3 = [
                            'TIADA(JALAN 1 ORG SHJ)',
                            'TIADA(JALAN 2 ORG SHJ)',
                            'TIADA(JALAN 3 ORG SHJ)',
                            'AJIS','AZRUL','DANISH','FIRDAUS','KADIAQ','RAHIMI','SHARIL'
                        ];
                    @endphp

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Team Leader Pasang</label>
                        <select name="team_leader" class="form-select" required>
                            <option value="">-- Select --</option>
                            @foreach($team as $person)
                                <option value="{{ $person }}">{{ $person }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Team Member 1 Pasang</label>
                        <select name="team_member_1" class="form-select" required>
                            <option value="">-- Select --</option>
                            @foreach($member1 as $person)
                                <option value="{{ $person }}">{{ $person }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Team Member 2 Pasang</label>
                        <select name="team_member_2" class="form-select" required>
                            <option value="">-- Select --</option>
                            @foreach($member2 as $person)
                                <option value="{{ $person }}">{{ $person }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Team Member 3 Pasang</label>
                        <select name="team_member_3" class="form-select" required>
                            <option value="">-- Select --</option>
                            @foreach($member3 as $person)
                                <option value="{{ $person }}">{{ $person }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Order Status</label>
                        <select name="order_status" class="form-select" required>
                            <option value="">-- Select --</option>
                            <option value="DONE">DONE</option>
                            <option value="RETURN">RETURN</option>
                            <option value="FORCE DONE(ICARE SURUH)">FORCE DONE (ICARE SURUH)</option>
                        </select>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Submit Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
