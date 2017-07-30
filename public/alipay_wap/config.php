<?php
$config = array(
    //应用ID,您的APPID。
    'app_id' => "2015121600991889",

    //商户私钥，您的原始格式RSA私钥
    'merchant_private_key' => "MIIEpAIBAAKCAQEAtRc9FbOt8ni1r5TD86MC3Q5Cjsa4YNxyt0uh9dSgwJiWU1vto6CB2+sYAXK37O/t34IMKny+QAMz/zpFghPjSmlGkMVeoRwUemT4nZZQLEzXM1venn5modsgv8LgFZslJP0VG+IPmHR7nWO5UVy1vXNaHgpC649rthCTP6We8w7wR5uKgVs2vEzTOAgPtAD8sPgLk1cPKeuUjbhWatjmtJ7yPTEBQ0nsNQlr8EJhn4LaA4PbmTgqhcvxzanObRFII7stMZjUHfyq/xwznRr+/C3Q09y3Usr5NAUtM1d/sJekTuhwEGJmDXG4aLilo3rOzLPMqWlxq0nhUIpcX6q5YwIDAQABAoIBAGRFOc2KcAaSUAeol9ePq0Y7Xx8vaWg4qExV1JgJ4/jAhHwjqrGvbjgXNHOY0b6gG1Zm69WavL01CNWJrnMYEAJjyG7g2kTbB3u97OtVD493/LCzbdDUrH9yle+YN/u+rBKPD+EgiwIffVLopPQoIXmFJaD8jZFhGIL3KpFTY2+xJn20Q9TKEjI00uxvQhY4fVudzLUYROgQ4DFcNM7FRb/YLcX85khpveihVUOrWzofQTRN3RM9oCshBpYE+MFiiZckdH+RERRIMpU2UYdfyy+VhZR0y0QgKi5i/v6KF0JTvWIyn3IA3jGSBWrJTQMvnET66UFNYTin5nwOHnG6tAECgYEA6xb7+Uz+SWQ6ZL9aWLqDthTIPFN/eRs9guyr8JzqBEq4suaQnokt2mDPjPQeTEbhANKa/K4QVOH6+bFsNb2ephNbtoCqINkyTSuzoOWCts6GvP93lbwBeDGvIUlYQ6a6WwrjxNJ7qws4af1WvVpl2J8WWiC5vwCdUlwveGdp9rkCgYEAxTKxKjLpEX1/NOV5dtKy3bhwinz8My06bUSEOihGVJtaaZEFNYojP8CXWKDvCj7vigptCZPT8cv9xLPc3xMJWzkibdvJG8DGQSyESvHxGKmVi6Hd6MAExm/1GwdHxah9HnG7g7P3UltH0WBxUPH3ZGypT8uTAooaDZJ1yyNrYvsCgYEAjTJW0Jsft3DNaalMWDJd3USKJ0F3NIPZ5ALGGlQEceN3H2w/vBhkQ98ViXEtqV6A0X+susrI4FKB7OpVNcnXuaOy1+BbTjNldNgkoSR359gPMQC3EGXE9C3TI8jrjGZdU0UtHA/XWxn4HiCcsknTFdInGKbDKSbzVn4rvMNP73ECgYEAi/PeKMTZBMC8dx4lhl8i8pjjxmXN18RRoxrtfRj4UTOwhxuVRtozChv1TcFp5SuldaLQn+t6kDDmeaPtLaSlD0kNVkqWAExgaADgIxByu74flGncxEMDIJJ0sioIlg9uPR0ap+4hqSF/Zum7gmc33N4Bi9A/FZ5NvzQixXjtzeECgYAfh4vEJI0lIQP6bGVz8xsEqbnhB7JRxJ6My0hXenwQWX81VNvuB+bum6asbMmfYZhnIBGHKACpQHyfVuYWhJScRcczQAOoU3GOfgD3X7ylwws//k3ewb3K5by/0ujmbsR0Dr/2jZFCpXasTAbZwC9ZfBQPH4hRP5mso1l4WLZtug==",

    //异步通知地址
    'notify_url' => "http://180.76.141.156/alipay_wap/notify_url.php",

    //同步跳转
    'return_url' => "http://180.76.141.156/alipay_wap/return_url.php",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type' => "RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

    //支付宝公钥
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAm+ieZJofVaMcL1TSMfV+OjWDEy6GFi6ErVBCBxioq5Qcn5wbbmY4HQYM7rdHTRRE8YWEuJUuNhcY2xU6YWL2k31NdZna23OYppbuSxmrhoUxjMALI/PMeDNPKErGgDS6LIIqxCEwc5ZCS+8GaeH9RLK6TPsrJhOlKDcADjJxU6cG/BRIkBMxWtetWQLEEFES9niqJ24KsGYZ2pHVGndq725L5ItsiZh3wEdxF/mW+fBHVQ+pm4rU2J8hERXN/nO2MuzGOiAApI0CMDUReuf1mQpL5hLrf3+0DwLi8iag+EQlTyhVLjfCeYWYEzs5cUh13auEMI68QoiUljiVYgqqyQIDAQAB",


);