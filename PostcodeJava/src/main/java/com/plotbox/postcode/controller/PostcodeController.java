package com.plotbox.postcode.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;

import com.plotbox.postcode.service.PostcodeService;

@Controller
public class PostcodeController {

    @Autowired
    private PostcodeService postcodeService;

    @GetMapping("/")
    public String index() {
        return "index";
    }

    @PostMapping("/search")
    public String searchPostcode(@RequestParam("postcode") String postcode, Model model) {
        String response = postcodeService.searchPostcode(postcode);
        if (response != null) {
            model.addAttribute("result", response);
        } else {
            model.addAttribute("error", "Postcode not found");
        }
        return "index";
    }
}
