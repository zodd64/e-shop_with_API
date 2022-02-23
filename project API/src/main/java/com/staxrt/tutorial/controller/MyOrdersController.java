package com.staxrt.tutorial.controller;

import com.staxrt.tutorial.repository.MyOrdersRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@CrossOrigin
@RequestMapping("/api/v1")
public class MyOrdersController {

    @Autowired
    private MyOrdersRepository repo;

    @GetMapping("/myOrders/{uid}")
    public ResponseEntity<Object> getMyOrders(@PathVariable(value = "uid") Long userId){
    List<Object[]> orderDetails = repo.find(userId);

        return ResponseEntity.ok().body(orderDetails);

    }
}
