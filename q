[1mdiff --git a/resources/emails/notificationForOffer.blade.php b/resources/emails/notificationForOffer.blade.php[m
[1mnew file mode 100644[m
[1mindex 0000000..a00a459[m
[1m--- /dev/null[m
[1m+++ b/resources/emails/notificationForOffer.blade.php[m
[36m@@ -0,0 +1,70 @@[m
[32m+[m[32m<!DOCTYPE html>[m
[32m+[m[32m<html>[m
[32m+[m[32m<head>[m
[32m+[m	[32m<title></title>[m
[32m+[m[32m</head>[m
[32m+[m[32m<body>[m
[32m+[m[32mHello, {{$first_name}} {{$last_name}} . <b>You have a new user, who want to review your request: {{$request_title}}</b>>. <hr>[m
[32m+[m[32m<table class="two-col" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 600px;background-color: #ffffff;table-layout: fixed" emb-background-style="">[m
[32m+[m[32m    <tbody>[m
[32m+[m[32m        <tr>[m
[32m+[m[32m            <td class="column first" style="padding: 0;vertical-align: top;text-align: left;width: 300px">[m
[32m+[m	[32m            <div><div class="column-top" style="font-size: 50px;line-height: 50px">&nbsp;</div></div>[m
[32m+[m	[41m              [m	[32m<table class="contents" style="border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%">[m
[32m+[m[32m                        <tbody>[m
[32m+[m		[32m                <tr>[m
[32m+[m			[32m                  <td class="padded" style="padding: 0;vertical-align: top;padding-left: 50px;padding-right: 25px;word-break: break-word;word-wrap: break-word">[m
[32m+[m								[32m  <div class="image" style="font-size: 12px;Margin-bottom: 21px;mso-line-height-rule: at-least;color: #60666d;font-family: sans-serif" align="center">[m
[32m+[m								[32m    <img style="border: 0;-ms-interpolation-mode: bicubic;display: block;max-width: 480px" src="{{$avatar}}" alt="" width="225" height="225">[m
[32m+[m								[32m  </div>[m
[32m+[m			[32m                  </td>[m
[32m+[m		[32m                </tr>[m
[32m+[m		[32m              </tbody>[m
[32m+[m	[41m              [m	[32m</table>[m
[32m+[m	[41m           [m		[32m<div class="column-bottom" style="font-size: 29px;line-height: 29px">&nbsp;</div>[m
[32m+[m	[32m        </td>[m
[32m+[m	[32m        <td class="column second" style="padding: 0;vertical-align: top;text-align: left;width: 300px">[m
[32m+[m	[32m            <div><div class="column-top" style="font-size: 50px;line-height: 50px">&nbsp;</div></div>[m
[32m+[m		[32m        <table class="contents" style="border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%">[m
[32m+[m		[41m        [m	[32m<tbody>[m
[32m+[m		[41m        [m		[32m<tr>[m
[32m+[m						[32m    <td class="padded" style="padding: 0;vertical-align: top;padding-left: 25px;padding-right: 50px;word-break: break-word;word-wrap: break-word">[m
[32m+[m[32m                                <h2 style="Margin-top: 0;color: #44a8c7;font-weight: 700;font-size: 20px;Margin-bottom: 14px;font-family: sans-serif;line-height: 26px">General information</h2>[m
[32m+[m[32m                                <p style="Margin-top: 0;color: #60666d;font-size: 13px;font-family: sans-serif;">Name: {{$offer_first_name}} {{$offer_last_name}}</p>[m
[32m+[m[32m                                <p style="Margin-top: 0;color: #60666d;font-size: 13px;font-family: sans-serif;">Job: {{$offer_job}}</p>[m
[32m+[m[32m                                <p style="Margin-top: 0;color: #60666d;font-size: 13px;font-family: sans-serif;">Phone: {{$offer_phone}}</p>[m
[32m+[m[32m                                <p style="Margin-top: 0;color: #60666d;font-size: 13px;font-family: sans-serif;">Email: {{$offer_email}}</p>[m
[32m+[m[32m                                <p style="Margin-top: 0;color: #60666d;font-size: 13px;font-family: sans-serif;">Reputation: {{$offer_reputation}}</p>[m
[32m+[m							[32m</td>[m
[32m+[m		[32m                </tr>[m
[32m+[m		[32m            </tbody>[m
[32m+[m		[32m        </table>[m
[32m+[m[41m	                        [m
[32m+[m	[32m            <table class="contents" style="border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%">[m
[32m+[m	[41m               [m	[32m<tbody>[m
[32m+[m	[41m                [m	[32m<tr>[m
[32m+[m	[41m                   [m		[32m<td class="padded" style="padding: 0;vertical-align: top;padding-left: 25px;padding-right: 50px;word-break: break-word;word-wrap: break-word">[m
[32m+[m	[41m                      [m		[32m<div style="height:20px">&nbsp;</div>[m
[32m+[m	[41m                    [m	[32m</td>[m
[32m+[m	[41m                [m	[32m</tr>[m
[32m+[m	[41m              [m	[32m</tbody>[m
[32m+[m	[32m            </table>[m
[32m+[m[41m	                        [m
[32m+[m	[32m            <table class="contents" style="border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%">[m
[32m+[m	[41m               [m	[32m<tbody>[m
[32m+[m	[41m                [m	[32m<tr>[m
[32m+[m	[41m                   [m		[32m<td class="padded" style="padding: 0;vertical-align: top;padding-left: 25px;padding-right: 50px;word-break: break-word;word-wrap: break-word">[m
[32m+[m	[41m          [m					[32m<div class="btn" style="Margin-bottom: 24px;text-align: left">[m
[32m+[m[32m                                    <a style="border: 0;border-radius: 4px;display: inline-block;font-size: 12px;font-weight: 700;line-height: 19px;padding: 6px 17px 6px 17px;text-align: center;text-decoration: none;color: #fff;background-color: #5c91ad;box-shadow: 0 3px 0 #4a748a;font-family: sans-serif" href="http://http://" target="_blank">Accepted</[m
[32m+[m[32m                                    <a style="border: 0;border-radius: 4px;display: inline-block;font-size: 12px;font-weight: 700;line-height: 19px;padding: 6px 17px 6px 17px;text-align: center;text-decoration: none;color: #fff;background-color: #5c91ad;box-shadow: 0 3px 0 #4a748a;font-family: sans-serif" href="http://http://" target="_blank">Declined</a>[m[41m                             [m
[32m+[m[32m                                </div>[m
[32m+[m[32m                            </td>[m
[32m+[m[32m                        </tr>[m
[32m+[m[32m                    </tbody>[m
[32m+[m	[32m            </table>[m
[32m+[m[32m                <div class="column-bottom" style="font-size: 29px;line-height: 29px">&nbsp;</div>[m
[32m+[m[32m            </td>[m
[32m+[m[32m        </tbody>[m
[32m+[m[32m    </table>[m
[32m+[m[32m</body>[m
[32m+[m[32m</html>[m
\ No newline at end of file[m
