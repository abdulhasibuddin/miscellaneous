# Multi-Segment Trapezoidal Rule::(with Python)
import math
def func(x):
    return (5*x*math.exp(-2*x))  #function goes here...

def main():
    print "Enter Range [a,b]:\nLower limit, a = "
    a = input()
    print "Upper limit, b = "
    b = input()
    print "Num of segment = "
    n = input()

    h = (b - a) / n
    sum = func(a)
    sum = sum + func(b)

    sum_value = 0
    for i in range(1,n):
        value = a + i*h
        sum_value = sum_value + (func(value))

    sum = ((b-a)/(2*n))*(sum + 2*sum_value)

    print "Result = " + str(sum)

if __name__=="__main__":
    main()

raw_input()


