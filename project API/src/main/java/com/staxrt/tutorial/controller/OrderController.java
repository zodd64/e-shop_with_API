package com.staxrt.tutorial.controller;

import com.staxrt.tutorial.exception.ResourceNotFoundException;
import com.staxrt.tutorial.model.Order;
import com.staxrt.tutorial.repository.OrderRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import javax.validation.Valid;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * The type Order controller.
 *
 * @author 4402
 */
@RestController
@CrossOrigin
@RequestMapping("/api/v1")
public class OrderController {

  @Autowired
  private OrderRepository orderRepository;

  /**
   * Get all orders list.
   *
   * @return the list
   */
  @GetMapping("/orders")
  public List<Order> getAllOrders() {
    return orderRepository.findAll();
  }

  /**
   * Gets orders by oid.
   *
   * @param orderId the order oid
   * @return the order by oid
   * @throws ResourceNotFoundException the resource not found exception
   */
  @GetMapping("/orders/{oid}")
  public ResponseEntity<Order> getOrdersById(@PathVariable(value = "oid") Long orderId)
      throws ResourceNotFoundException {
    Order order =
        orderRepository
            .findById(orderId)
            .orElseThrow(() -> new ResourceNotFoundException("Order not found on :: " + orderId));
    return ResponseEntity.ok().body(order);
  }

  /**
   * Create order order.
   *
   * @param order the order
   * @return the order
   */
  @PostMapping("/orders")
  public Order createOrder(@Valid @RequestBody Order order) {
    return orderRepository.save(order);
  }

  /**
   * Update order response entity.
   *
   * @param orderId the order id
   * @param orderDetails the order details
   * @return the response entity
   * @throws ResourceNotFoundException the resource not found exception
   */
  @PutMapping("/orders/{oid}")
  public ResponseEntity<Order> updateOrder(
      @PathVariable(value = "oid") Long orderId, @Valid @RequestBody Order orderDetails)
      throws ResourceNotFoundException {

    Order order =
        orderRepository
            .findById(orderId)
            .orElseThrow(() -> new ResourceNotFoundException("Order not found on :: " + orderId));

    order.setPid(orderDetails.getPid());
    order.setUid(orderDetails.getUid());
    order.setDate(orderDetails.getDate());
    final Order updatedOrder = orderRepository.save(order);
    return ResponseEntity.ok(updatedOrder);
  }

  /**
   * Delete order map.
   *
   * @param orderId the order oid
   * @return the map
   * @throws Exception the exception
   */
  @DeleteMapping("/orders/{oid}")
  public Map<String, Boolean> deleteOrder(@PathVariable(value = "oid") Long orderId) throws Exception {
    Order order =
        orderRepository
            .findById(orderId)
            .orElseThrow(() -> new ResourceNotFoundException("Order not found on :: " + orderId));

    orderRepository.delete(order);
    Map<String, Boolean> response = new HashMap<>();
    response.put("deleted", Boolean.TRUE);
    return response;
  }
}
