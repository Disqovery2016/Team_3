package com.example.yashd.pulseit;

import android.content.ActivityNotFoundException;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.net.Uri;
import android.os.Bundle;
import android.os.IBinder;
import android.support.v7.app.AppCompatActivity;
import android.telephony.TelephonyManager;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import static com.example.yashd.pulseit.MainActivity.GPSTracker.MIN_DISTANCE_CHANGE_FOR_UPDATES;
import static com.example.yashd.pulseit.MainActivity.GPSTracker.MIN_TIME_BW_UPDATES;
import static java.lang.Integer.parseInt;

public class MainActivity extends AppCompatActivity {
EditText pulse,due;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
         pulse = (EditText) findViewById(R.id.editText);

        Button submit = (Button) findViewById(R.id.button);

        submit.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                buttonOnClick();
            }
        });
    }

    public void buttonOnClick(){
        String val = pulse.getText().toString();

        if (parseInt(val)>220||parseInt(val)<40)
        {
            call();

        }
        else
        {
        pulse.setText("You have a normal heart rate :)");
        }
    }


        private void call() {
            try {
                Intent callIntent = new Intent(Intent.ACTION_CALL);
                callIntent.setData(Uri.parse("tel:7506945191"));
                startActivity(callIntent);
            } catch (ActivityNotFoundException activityException) {
                Log.e("helloandroid dialing example", "Call failed", activityException);
            }
        }

    public class CallDurationReceiver extends BroadcastReceiver {

         boolean flag = false;
         Long start_time, end_time;

        @Override
        public void onReceive(Context arg0, Intent intent) {
            String action = intent.getAction();
            if (action.equalsIgnoreCase("android.intent.action.PHONE_STATE")) {
                if (intent.getStringExtra(TelephonyManager.EXTRA_STATE).equals(
                        TelephonyManager.EXTRA_STATE_RINGING)) {
                    start_time = System.currentTimeMillis();
                }
                if (intent.getStringExtra(TelephonyManager.EXTRA_STATE).equals(
                        TelephonyManager.EXTRA_STATE_IDLE)) {
                    end_time = System.currentTimeMillis();
                    //Total time talked =
                    Long total_time = end_time - start_time;
                    //Store total_time somewhere or pass it to an Activity using intent
                    setContentView(R.layout.activity_main);
                    TextView textView = (TextView) findViewById(R.id.duration);
                   // textView.setText(String.valueOf(total_time));
                    if(total_time>0)
                    {
                        textView.setText("i sgreater than ");
                    }
                }
            }
        }
    }


