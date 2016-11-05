package com.example.yashd.pulseit;

import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.Toast;
import android.app.Activity;
import android.view.View;
import static java.lang.Integer.parseInt;

public class MainActivity extends AppCompatActivity {
    EditText pulse;
    ImageView imageView;
    ImageButton imgButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        pulse = (EditText) findViewById(R.id.editText);
       // imageView = (ImageView) findViewById(R.id.imageView2);

        Button submit = (Button) findViewById(R.id.button);

        submit.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                buttonOnClick();
            }
        });

        imgButton =(ImageButton)findViewById(R.id.imageView2);
        imgButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Log.i("clicks","You Clicked B1");
                Intent i=new Intent(
                        MainActivity.this,
                        Main2Activity.class);
                startActivity(i);
            }
        });
    }

    public void buttonOnClick() {
        String val = pulse.getText().toString();
        imgButton.setImageResource(R.drawable.image2);


        if (parseInt(val) > 220 || parseInt(val) < 40) {
            call();
        }
        else {
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
}


/*
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
                    if (total_time > 0) {
                        textView.setText("i sgreater than ");
                    }
                }
            }
        }
    }*/



