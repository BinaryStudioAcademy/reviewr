<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
Hello, {{$author->first_name}} {{$author->last_name}} . You have a new user, who want to review your request: <b>{{$request->title}}</b>. <hr>
<table class="two-col" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto;width: 600px;background-color: #ffffff;table-layout: fixed" emb-background-style="">
    <tbody>
        <tr>
            <td class="column first" style="padding: 0;vertical-align: top;text-align: left;width: 300px">
	            <div><div class="column-top" style="font-size: 50px;line-height: 50px">&nbsp;</div></div>
                    <table class="contents" style="border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%">
                        <tbody>
                            <tr>
                                <td class="padded" style="padding: 0;vertical-align: top;padding-left: 50px;padding-right: 25px;word-break: break-word;word-wrap: break-word">
                                    <div class="image" style="font-size: 12px;Margin-bottom: 21px;mso-line-height-rule: at-least;color: #60666d;font-family: sans-serif" align="center">
                                        <img style="border: 0;-ms-interpolation-mode: bicubic;display: block;max-width: 480px" src="{{$user->avatar}}" alt="" width="225" height="225">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <div class="column-bottom" style="font-size: 29px;line-height: 29px">&nbsp;</div>
            </td>
            <td class="column second" style="padding: 0;vertical-align: top;text-align: left;width: 300px">
                <div><div class="column-top" style="font-size: 50px;line-height: 50px">&nbsp;</div></div>
                <table class="contents" style="border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%">
                    <tbody>
                        <tr>
                            <td class="padded" style="padding: 0;vertical-align: top;padding-left: 25px;padding-right: 50px;word-break: break-word;word-wrap: break-word">
                                <h2 style="Margin-top: 0;color: #44a8c7;font-weight: 700;font-size: 20px;Margin-bottom: 14px;font-family: sans-serif;line-height: 26px">General information</h2>
                                <p style="Margin-top: 0;color: #60666d;font-size: 13px;font-family: sans-serif;">Name: {{$user->first_name}} {{$user->last_name}}</p>
                                <p style="Margin-top: 0;color: #60666d;font-size: 13px;font-family: sans-serif;">Job: {{$user->job->position}}</p>
                                <p style="Margin-top: 0;color: #60666d;font-size: 13px;font-family: sans-serif;">Address: {{$user->address}}</p>
                                <p style="Margin-top: 0;color: #60666d;font-size: 13px;font-family: sans-serif;">Phone: {{$user->phone}}</p>
                                <p style="Margin-top: 0;color: #60666d;font-size: 13px;font-family: sans-serif;">Email: {{$user->email}}</p>
                                <p style="Margin-top: 0;color: #60666d;font-size: 13px;font-family: sans-serif;">Reputation: {{$user->reputation}}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                            
                <table class="contents" style="border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%">
                    <tbody>
                        <tr>
                            <td class="padded" style="padding: 0;vertical-align: top;padding-left: 25px;padding-right: 50px;word-break: break-word;word-wrap: break-word">
                                <div style="height:20px">&nbsp;</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                            
                <table class="contents" style="border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%">
                    <tbody>
                        <tr>
                        <td class="padded" style="padding: 0;vertical-align: top;padding-left: 25px;padding-right: 50px;word-break: break-word;word-wrap: break-word">
                                <div class="btn" style="Margin-bottom: 24px;text-align: left">
                                    <a style="border: 0;border-radius: 4px;display: inline-block;font-size: 12px;font-weight: 700;line-height: 19px;padding: 6px 17px 6px 17px;text-align: center;text-decoration: none;color: #fff;background-color: #5c91ad;box-shadow: 0 3px 0 #4a748a;font-family: sans-serif" href="localhost:8000/user/{{$user->id}}/accept/{{$request->id}}" target="_blank">Accept</a>
                                    <a style="border: 0;border-radius: 4px;display: inline-block;font-size: 12px;font-weight: 700;line-height: 19px;padding: 6px 17px 6px 17px;text-align: center;text-decoration: none;color: #fff;background-color: #5c91ad;box-shadow: 0 3px 0 #4a748a;font-family: sans-serif" href="localhost:8000/user/{{$user->id}}/decline/{{$request->id}}" target="_blank">Decline</a>                             
                                </div>
                            </td>
                        </tr>
                    </tbody>
	            </table>
                <div class="column-bottom" style="font-size: 29px;line-height: 29px">&nbsp;</div>
            </td>
        </tbody>
    </table>
</body>
</html>
