package com.staxrt.tutorial.controller;

import com.staxrt.tutorial.UserServices;
import com.staxrt.tutorial.model.User;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;
import javax.mail.MessagingException;
import java.io.UnsupportedEncodingException;

@RestController
@CrossOrigin
@RequestMapping("/api/v1")
public class RegisterController {

    @Autowired
    private UserServices service;

    @PostMapping("/register")
    public String processRegister(User user)
            throws UnsupportedEncodingException, MessagingException {
        service.register(user, "http://localhost/project/scripts/do_Verification.php");
        return "register_success";
    }


}
