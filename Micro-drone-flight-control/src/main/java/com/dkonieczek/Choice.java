package com.dkonieczek;

import android.content.Intent;
import android.graphics.Typeface;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;

/**
 *  Modified by: Dennis Konieczek @dkonieczek
 *               Nikolas Spendik @nspendik22
 *  Repository: https://github.com/dkonieczek/micro-drone-flight-control
 * */
public class Choice extends AppCompatActivity {

    private String username;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_choice);

        Bundle extras = getIntent().getExtras();
        username = extras.getString("username");

        Button btn1 = (Button) findViewById(R.id.btn1);

        Typeface customFont = Typeface.createFromAsset(getAssets(), "fonts/redfive.TTF");
        btn1.setTypeface(customFont);
        btn1 = (Button)findViewById(R.id.btn1);
        btn1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(Choice.this, sendData.class);
                intent.putExtra("username", username);
                startActivity(intent);
            }
        });
    }
}
