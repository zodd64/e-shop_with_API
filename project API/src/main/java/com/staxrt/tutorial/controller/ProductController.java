package com.staxrt.tutorial.controller;

import com.staxrt.tutorial.exception.ResourceNotFoundException;
import com.staxrt.tutorial.model.Product;
import com.staxrt.tutorial.repository.ProductRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import javax.validation.Valid;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * The type Product controller.
 *
 * @author 4402
 */
@RestController
@CrossOrigin
@RequestMapping("/api/v1")
public class ProductController {

  @Autowired
  private ProductRepository productRepository;

  /**
   * Get all products list.
   *
   * @return the list
   */
  @GetMapping("/products")
  public List<Product> getAllProducts() {
    return productRepository.findAll();
  }

  /**
   * Gets products by pid.
   *
   * @param productId the product pid
   * @return the product by pid
   * @throws ResourceNotFoundException the resource not found exception
   */
  @GetMapping("/products/{pid}")
  public ResponseEntity<Product> getProductsById(@PathVariable(value = "pid") Long productId)
      throws ResourceNotFoundException {
    Product product =
        productRepository
            .findById(productId)
            .orElseThrow(() -> new ResourceNotFoundException("Product not found on :: " + productId));
    return ResponseEntity.ok().body(product);
  }

  /**
   * Create product product.
   *
   * @param product the product
   * @return the product
   */
  @PostMapping("/products")
  public Product createProduct(@Valid @RequestBody Product product) {
    return productRepository.save(product);
  }

  /**
   * Update product response entity.
   *
   * @param productId the product id
   * @param productDetails the product details
   * @return the response entity
   * @throws ResourceNotFoundException the resource not found exception
   */
  @PutMapping("/products/{pid}")
  public ResponseEntity<Product> updateProduct(
      @PathVariable(value = "pid") Long productId, @Valid @RequestBody Product productDetails)
      throws ResourceNotFoundException {

    Product product =
        productRepository
            .findById(productId)
            .orElseThrow(() -> new ResourceNotFoundException("Product not found on :: " + productId));

    product.setModel(productDetails.getModel());
    product.setPhotoURL(productDetails.getPhotoURL());
    product.setScreenSize(productDetails.getScreenSize());
    product.setCpu(productDetails.getCpu());
    product.setRam(productDetails.getRam());
    product.setCamera(productDetails.getCamera());
    product.setBattery(productDetails.getBattery());
    product.setSar(productDetails.getSar());
    product.setPrice(productDetails.getPrice());
    product.setQuantity(productDetails.getQuantity());
    final Product updatedProduct = productRepository.save(product);
    return ResponseEntity.ok(updatedProduct);
  }

  /**
   * Delete product map.
   *
   * @param productId the product id
   * @return the map
   * @throws Exception the exception
   */
  @DeleteMapping("/products/{pid}")
  public Map<String, Boolean> deleteProduct(@PathVariable(value = "pid") Long productId) throws Exception {
    Product product =
        productRepository
            .findById(productId)
            .orElseThrow(() -> new ResourceNotFoundException("Product not found on :: " + productId));

    productRepository.delete(product);
    Map<String, Boolean> response = new HashMap<>();
    response.put("deleted", Boolean.TRUE);
    return response;
  }
}
